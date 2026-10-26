<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPurchase;
use App\Support\SubscriptionAccess;
use Illuminate\Support\Facades\Auth;
use \Stripe\Stripe;
use Stripe\PaymentIntent;
use \Stripe\Checkout\Session as StripeSession;
use \Stripe\Charge as StripeCharge;
use App\Mail\SubscriptionPurchasedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class SubscriptionPurchaseController extends Controller
{
    private function accountContext(): ?array
    {
        foreach (['web'=>'buyer','supplier'=>'supplier','manufacturer'=>'manufacturer'] as $guard => $type) {
            if (Auth::guard($guard)->check()) return [$type, Auth::guard($guard)->user()];
        }
        return null;
    }

    private function createAccountSubscription(string $type, $account, SubscriptionPlan $plan, ?string $paymentReference = null): void
    {
        $start = now()->toDateString();
        $end = $this->calculateEndDate((string)$plan->duration);
        $paid = (float)$plan->price <= 0 || $paymentReference !== null;

        if ($type === 'buyer') {
            $commissionAmount = (float)$plan->price > 0
                ? $this->calculateCommissionAmount($plan->commission, (float)$plan->price)
                : 0.0;
            $attributes = [
                'user_id'=>$account->id, 'plan_name'=>$plan->name, 'price'=>$plan->price,
                'commission'=>$plan->commission, 'total_amount'=>(float)$plan->price+$commissionAmount,
                'commission_amount'=>$commissionAmount, 'start_date'=>$start, 'end_date'=>$end,
                'is_active'=>$paid, 'payment_status'=>$paid?'paid':'pending',
            ];
            DB::transaction(function () use ($account, $paymentReference, $attributes) {
                if ($paymentReference && SubscriptionPurchase::where('stripe_id', $paymentReference)->exists()) return;
                SubscriptionPurchase::where('user_id', $account->id)->where('is_active', true)->update(['is_active'=>false]);
                if ($paymentReference) SubscriptionPurchase::create($attributes + ['stripe_id'=>$paymentReference]);
                else SubscriptionPurchase::create($attributes);
            });
            return;
        }

        $table = $type === 'supplier' ? 'supplier_subscription_purchases' : 'manufacturer_subscription_purchases';
        $ownerColumn = $type.'_id';
        $referenceColumn = 'stripe_session_id';
        DB::transaction(function () use ($table, $ownerColumn, $account, $plan, $paymentReference, $referenceColumn, $paid, $start, $end) {
            if ($paymentReference && DB::table($table)->where($referenceColumn,$paymentReference)->exists()) return;
            DB::table($table)->where($ownerColumn,$account->id)->where('is_active',true)->update(['is_active'=>false,'updated_at'=>now()]);
            DB::table($table)->insert([$ownerColumn=>$account->id,'subscription_plan_id'=>$plan->id,'plan_name'=>$plan->name,$referenceColumn=>$paymentReference,'price'=>$plan->price,'payment_status'=>$paid?'paid':'pending','start_date'=>$start,'end_date'=>$end,'is_active'=>$paid,'created_at'=>now(),'updated_at'=>now()]);
        });
    }

    private function dashboardRoute(string $type): string
    {
        return match ($type) { 'supplier'=>'seller.dashboard', 'manufacturer'=>'manufacturer.dashboard', default=>'user.dashboard' };
    }

    private function upgradeAllowed(string $type, $account, SubscriptionPlan $plan): bool
    {
        $current = SubscriptionAccess::current($type, (int)$account->id);
        return !$current || (float)$plan->price > (float)($current->price ?? 0);
    }

    public function purchase(Request $request)
    {
        $context = $this->accountContext();
        if (!$context) {
            return response()->json(['redirect' => route('login')]);
        }
        [$type,$account] = $context;

        $request->validate([
            'plan_id' => 'required|integer|exists:subscription_plans,id',
        ]);

        $plan = SubscriptionPlan::findOrFail($request->input('plan_id'));
        if ($plan->status !== 'active') return response()->json(['error'=>'This subscription plan is not available.'],422);
        if (!$this->upgradeAllowed($type,$account,$plan)) return response()->json(['error'=>'You already have an active subscription. You can upgrade to a higher plan or purchase another plan after it expires.'],409);

        // Handle free plans directly
        if ((float)$plan->price <= 0) {
            $this->createAccountSubscription($type,$account,$plan);
            if ($type === 'buyer') {
                $purchase = SubscriptionPurchase::where('user_id',$account->id)->where('plan_name',$plan->name)->latest()->first();
                if ($purchase) $this->sendPurchaseConfirmation($purchase);
            }

            return response()->json(['redirect' => route($this->dashboardRoute($type))]);
        }

        if (!config('services.stripe.secret')) return response()->json(['error'=>'Online subscription payment is not configured.'],503);

        // Stripe Checkout session
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                    'unit_amount' => (int)($plan->price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/payment/success'),
            'cancel_url' => route('subscription.plan'),
            'customer_email' => $account->email,
            'metadata' => array_filter([
                'plan_id' => (string)$plan->id,
                'owner_type' => $type,
                'owner_id' => (string)$account->id,
                'user_id' => $type === 'buyer' ? (string)$account->id : null,
            ], static fn ($value) => $value !== null),
        ]);
         session(['stripe_session_id' => $session->id]);

        return response()->json(['stripe_url' => $session->url]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['error'=>'Subscription checkout could not be started. Please try again.'],422);
        }
    }

    public function success(Request $request)
    {
        $context = $this->accountContext();
        if (!$context) {
            return redirect()->route('login');
        }
        [$type,$account] = $context;

        $stripe_session_id = session('stripe_session_id');
        if (!$stripe_session_id) {
            return redirect()->route('home')->with('success', 'Missing payment session.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = StripeSession::retrieve($stripe_session_id);
            $paymentIntentId = $session->payment_intent;
            $sessionType = $session->metadata->owner_type ?? 'buyer';
            $sessionOwnerId = (string)($session->metadata->owner_id ?? $session->metadata->user_id ?? '');
            if (($session->payment_status ?? null) !== 'paid' || $sessionType !== $type || $sessionOwnerId !== (string)$account->id) {
                return redirect()->route('subscription.plan')->with('error', 'Subscription payment could not be verified for this account.');
            }

            // Verify payment intent status
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            if ($paymentIntent->status !== 'succeeded') {
                return redirect()->route('subscription.plan')->with('error', 'Payment not successful.');
            }

            $planId = $session->metadata->plan_id ?? null;
            if (!$planId) {
                return redirect()->route('subscription.plan')->with('error', 'Invalid payment metadata.');
            }

            $plan = SubscriptionPlan::find($planId);
            if (!$plan) {
                return redirect()->route('subscription.plan')->with('error', 'Plan not found.');
            }

            $this->createAccountSubscription($type,$account,$plan,$type==='buyer'?$paymentIntentId:$stripe_session_id);
            if ($type === 'buyer') {
                $purchase = SubscriptionPurchase::where('stripe_id',$paymentIntentId)->first();
                if ($purchase) $this->sendPurchaseConfirmation($purchase);
            }

            return redirect()->route($this->dashboardRoute($type))->with('success', 'Subscription purchased successfully!');
        } catch (\Exception $e) {
            return redirect()->route('subscription.plan')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    // Free plan method
    public function free(Request $request)
    {
        $context = $this->accountContext();
        if (!$context) {
            return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
        }
        [$type,$account]=$context;
        $validated=$request->validate(['plan_id'=>'nullable|integer|exists:subscription_plans,id','plan_name'=>'nullable|string|max:255']);
        $plan=!empty($validated['plan_id']) ? SubscriptionPlan::findOrFail($validated['plan_id']) : SubscriptionPlan::where('name',$validated['plan_name']??'')->firstOrFail();
        abort_unless($plan->status==='active' && (float)$plan->price<=0,422,'Only an active free plan can be activated here.');
        if (!$this->upgradeAllowed($type,$account,$plan)) return redirect()->back()->with('error','You already have an active subscription. Upgrade to a higher plan or wait until it expires.');
        $this->createAccountSubscription($type,$account,$plan);
        if($type==='buyer') { $purchase=SubscriptionPurchase::where('user_id',$account->id)->where('plan_name',$plan->name)->latest()->first(); if($purchase)$this->sendPurchaseConfirmation($purchase); }
        return redirect()->route($this->dashboardRoute($type))->with('success','Subscription activated successfully.');
    }

    public function charge(Request $request)
    {
        $context=$this->accountContext();
        if (!$context) {
            return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
        }
        [$type,$account]=$context;

        $validated = $request->validate([
            'stripeToken' => 'required|string',
            'plan_id' => 'nullable|integer|exists:subscription_plans,id',
            'plan_name' => 'nullable|string|max:255',
            'plan_price' => 'nullable|numeric|min:0',
        ]);

        $plan=!empty($validated['plan_id']) ? SubscriptionPlan::findOrFail($validated['plan_id']) : SubscriptionPlan::whereRaw('LOWER(name) = ?', [strtolower($validated['plan_name']??'')])->firstOrFail();
        abort_unless($plan->status==='active' && (float)$plan->price>0,422,'Select an active paid subscription plan.');
        if (!$this->upgradeAllowed($type,$account,$plan)) return response()->json(['status'=>'error','message'=>'You already have an active subscription. Select a higher plan to upgrade.'],409);
        if (isset($validated['plan_price']) && round((float)$validated['plan_price'],2)!==round((float)$plan->price,2)) {
            return response()->json(['status'=>'error','message'=>'The submitted plan price does not match the selected plan.'],422);
        }
        if (!config('services.stripe.secret')) return response()->json(['status'=>'error','message'=>'Online subscription payment is not configured.'],503);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = StripeCharge::create([
                'amount' => (int)round((float)$plan->price * 100),
                'currency' => 'usd',
                'source' => $validated['stripeToken'],
                'description' => 'Subscription purchase - ' . $plan->name,
                'metadata' => [
                    'owner_type' => $type,
                    'owner_id' => (string)$account->id,
                    'plan_id' => (string)$plan->id,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
        if (!($charge->paid ?? false) || ($charge->status ?? null) !== 'succeeded') {
            return response()->json(['status'=>'error','message'=>'The payment was not completed.'],422);
        }
        $this->createAccountSubscription($type,$account,$plan,$charge->id);
        if ($type==='buyer') {
            $purchase=SubscriptionPurchase::where('stripe_id',$charge->id)->first();
            if($purchase)$this->sendPurchaseConfirmation($purchase);
        }

        return response()->json(['status' => 'success', 'redirect' => route($this->dashboardRoute($type))]);
    }

    private function sendPurchaseConfirmation(SubscriptionPurchase $purchase): void
    {
        try {
            $purchase->loadMissing('user');
            Mail::to($purchase->user->email)->send(new SubscriptionPurchasedMail($purchase));
        } catch (\Throwable $exception) {
            Log::error('Subscription confirmation email could not be sent.', [
                'purchase_id' => $purchase->id,
                'exception' => $exception->getMessage(),
            ]);
        }
    }

    private function calculateCommissionAmount(?string $commission, float $base): float
    {
        if (!$commission) {
            return 0.0;
        }
        $commission = trim($commission);
        if (str_ends_with($commission, '%')) {
            $rate = (float)rtrim($commission, '%');
            return round(($rate / 100) * $base, 2);
        }
        return round((float)$commission, 2);
    }

    private function calculateEndDate(string $duration): string
    {
        $durationLower = strtolower(trim($duration));
        if (str_contains($durationLower, 'year')) return now()->addYear()->toDateString();
        if (str_contains($durationLower, 'month')) return now()->addMonth()->toDateString();
        if (preg_match('/(\d+)\s*day/', $durationLower, $m)) return now()->addDays((int)$m[1])->toDateString();
        return now()->addDays(30)->toDateString();
    }
}
