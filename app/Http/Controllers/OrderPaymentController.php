<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class OrderPaymentController extends Controller
{
    public function checkout(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['redirect' => route('login')]);
        }

        $user = Auth::user();

        $order = Order::where('user_id', $user->id)->findOrFail($id);

        if (($order->payment_status ?? 'pending') === 'paid') {
            return response()->json(['status' => 'already_paid']);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => (int) round($order->amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user.orders.success'),
            'cancel_url' => route('user.orders'),
            'customer_email' => $user->email,
            'metadata' => [
                'order_id' => (string) $order->id,
                'user_id' => (string) $user->id,
            ],
        ]);

        // Store Stripe session ID safely (NO URL)
        session(['stripe_session_id' => $session->id]);

        return response()->json(['stripe_url' => $session->url]);
    }

    public function success()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $stripeSessionId = session('stripe_session_id');

        if (!$stripeSessionId) {
            return redirect()->route('user.orders')
                ->with('error', 'Payment session missing.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Retrieve Stripe session
            $session = StripeSession::retrieve($stripeSessionId);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('user.orders')
                    ->with('error', 'Payment not completed.');
            }

            $orderId = $session->metadata->order_id ?? null;
            $user = Auth::user();

            if (!$orderId) {
                return redirect()->route('user.orders')
                    ->with('error', 'Invalid payment metadata.');
            }

            $order = Order::where('user_id', $user->id)->find($orderId);

            if (!$order) {
                return redirect()->route('user.orders')
                    ->with('error', 'Order not found.');
            }

            // Idempotent payment creation
            Payment::firstOrCreate(
                ['transaction_id' => $stripeSessionId],
                [
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'amount' => $order->amount,
                    'status' => 'paid',
                    'provider' => 'stripe',
                    'meta' => null,
                ]
            );

            $order->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
            ]);

            // Clear session
            session()->forget('stripe_session_id');

            return redirect()->route('user.orders')
                ->with('success', 'Payment successful. Order confirmed.');

        } catch (\Exception $e) {
            return redirect()->route('user.orders')
                ->with('error', 'Payment verification failed.');
        }
    }
}
