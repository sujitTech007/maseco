<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPurchase;
use Illuminate\Support\Facades\Auth;
use \Stripe\Stripe;
use Stripe\PaymentIntent;
use \Stripe\Checkout\Session as StripeSession;
use \Stripe\Charge as StripeCharge;


class SubscriptionPurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['redirect' => route('login')]);
        }

        $user = Auth::user();

        // Only allow normal users
        if (Auth::guard('supplier')->check() || Auth::guard('manufacturer')->check()) {
            return response()->json(['error' => 'This plan is not for suppliers or manufacturers.']);
        }

        $request->validate([
            'plan_id' => 'required|integer|exists:subscription_plans,id',
        ]);

        $plan = SubscriptionPlan::findOrFail($request->input('plan_id'));

        // Handle free plans directly
        if ((float)$plan->price <= 0) {
            $commissionAmount = $this->calculateCommissionAmount($plan->commission, 0);
            SubscriptionPurchase::create([
                'user_id' => $user->id,
                'stripe_id' => null,
                'plan_name' => $plan->name,
                'price' => 0,
                'commission' => $plan->commission,
                'total_amount' => 0,
                'commission_amount' => $commissionAmount,
                'start_date' => now()->toDateString(),
                'end_date' => $this->calculateEndDate($plan->duration),
                'is_active' => 1,
                'payment_status' => 'paid',
            ]);

            return response()->json(['redirect' => route('payment.success')]);
        }

        // Stripe Checkout session
        Stripe::setApiKey(config('services.stripe.secret'));

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
            'customer_email' => $user->email,
            'metadata' => [
                'plan_id' => (string)$plan->id,
                'user_id' => (string)$user->id,
            ],
        ]);
         session(['stripe_session_id' => $session->id]);

        return response()->json(['stripe_url' => $session->url]);
    }

    public function success(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $stripe_session_id = session('stripe_session_id');
        if (!$stripe_session_id) {
            return redirect()->route('home')->with('success', 'Missing payment session.');
        }

        if (!$stripe_session_id) {
        $planId = 1; // default free plan
        $plan = SubscriptionPlan::find($planId);
        if (!$plan) {
            return redirect()->route('subscription.plan')->with('error', 'Plan not found.');
        }

        $user = Auth::user();
        $commissionAmount = $this->calculateCommissionAmount($plan->commission, $plan->price);

        SubscriptionPurchase::firstOrCreate(
            ['user_id' => $user->id, 'plan_name' => $plan->name],
            [
                'stripe_id' => $stripe_session_id,
                'price' => $plan->price,
                'commission' => $plan->commission,
                'total_amount' => $plan->price + $commissionAmount,
                'commission_amount' => $commissionAmount,
                'start_date' => now()->toDateString(),
                'end_date' => $this->calculateEndDate($plan->duration),
                'is_active' => 1,
                'payment_status' => 'paid',
            ]
        );

        return redirect()->route('subscription.plan')->with('success', 'Subscription purchased successfully!');
    }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = StripeSession::retrieve($stripe_session_id);
            $paymentIntentId = $session->payment_intent;

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

            $user = Auth::user();
            $commissionAmount = $this->calculateCommissionAmount($plan->commission, $plan->price);

            SubscriptionPurchase::firstOrCreate(
                ['stripe_id' => $paymentIntentId], // store actual payment ID
                [
                    'user_id' => $user->id,
                    'plan_name' => $plan->name,
                    'price' => $plan->price,
                    'commission' => $plan->commission,
                    'total_amount' => $plan->price + $commissionAmount,
                    'commission_amount' => $commissionAmount,
                    'start_date' => now()->toDateString(),
                    'end_date' => $this->calculateEndDate($plan->duration),
                    'is_active' => 1,
                    'payment_status' => 'paid',
                ]
            );

            return redirect()->route('subscription.plan')->with('success', 'Subscription purchased successfully!');
        } catch (\Exception $e) {
            return redirect()->route('subscription.plan')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    // Free plan method
    public function free(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
        }

        $user = Auth::user();

        $validated = $request->validate([
            'plan_name' => 'required|string',
            'plan_price' => 'nullable|numeric',
            'plan_duration' => 'nullable|string',
        ]);

        $plan = SubscriptionPlan::whereRaw('LOWER(name) = ?', [strtolower($validated['plan_name'])])->first();

        $price = 0.0;
        $duration = $validated['plan_duration'] ?? ($plan->duration ?? '30 days');
        $commission = $plan->commission ?? null;

        $commissionAmount = $this->calculateCommissionAmount($commission, $price);

        SubscriptionPurchase::create([
            'user_id' => $user->id,
            'stripe_id' => null,
            'plan_name' => $plan->name ?? $validated['plan_name'],
            'price' => $price,
            'commission' => $commission,
            'total_amount' => 0,
            'commission_amount' => $commissionAmount,
            'start_date' => now()->toDateString(),
            'end_date' => $this->calculateEndDate($duration),
            'is_active' => 1,
            'payment_status' => 'paid',
        ]);

        return redirect()->back()->with('success', 'Subscription purchased successfully!');

        // return response()->json(['status' => 'success']);
    }

    public function charge(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
        }

        $user = Auth::user();

        $validated = $request->validate([
            'stripeToken' => 'required|string',
            'plan_name' => 'required|string',
            'plan_price' => 'required|numeric|min:0',
            'plan_duration' => 'nullable|string',
        ]);

        $plan = SubscriptionPlan::whereRaw('LOWER(name) = ?', [strtolower($validated['plan_name'])])->first();
        $price = (float)$validated['plan_price'];
        $duration = $validated['plan_duration'] ?? ($plan->duration ?? '30 days');
        $commission = $plan->commission ?? null;

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = StripeCharge::create([
                'amount' => (int)round($price * 100),
                'currency' => 'usd',
                'source' => $validated['stripeToken'],
                'description' => 'Subscription purchase - ' . ($plan->name ?? $validated['plan_name']),
                'metadata' => [
                    'user_id' => (string)$user->id,
                    'plan_name' => $plan->name ?? $validated['plan_name'],
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }

        $commissionAmount = $this->calculateCommissionAmount($commission, $price);

        SubscriptionPurchase::create([
            'user_id' => $user->id,
            'stripe_id' => $charge->id,
            'plan_name' => $plan->name ?? $validated['plan_name'],
            'price' => $price,
            'commission' => $commission,
            'total_amount' => $price + $commissionAmount,
            'commission_amount' => $commissionAmount,
            'start_date' => now()->toDateString(),
            'end_date' => $this->calculateEndDate($duration),
            'is_active' => 1,
            'payment_status' => 'paid',
        ]);

        return response()->json(['status' => 'success']);
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
