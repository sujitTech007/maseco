<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Support\PhoneNumber;

use App\Models\Order;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

use App\Models\Enquiry;

use App\Models\SubscriptionPurchase;
use App\Models\SampleOrder;



class UserDashboardController extends Controller

{

    public function dashboard()

    {

        $user = Auth::user();

        $ordersCount = Order::where('user_id', $user->id)->count();

        $enquiriesCount = Enquiry::where('user_id', $user->id)->count();

        $paymentsTotal = \App\Models\Payment::where('user_id', $user->id)->sum('amount');

        $activeSubscription = SubscriptionPurchase::where('user_id', $user->id)

            ->where('payment_status', 'paid')

            ->latest()

            ->first();



        return view('user.dashboard', compact('user', 'ordersCount', 'enquiriesCount', 'paymentsTotal', 'activeSubscription'));

    }



    public function profile()

    {

        $user = Auth::user();

        return view('user.profile.index', compact('user'));

    }



    public function updateProfile(Request $request)

    {

        $user = Auth::user();

        if ($request->filled('phone')) {
            $request->merge([
                'phone' => PhoneNumber::normalizeLocal(
                    (string) $request->input('phone'),
                    (string) $request->input('country_code')
                ),
            ]);
        }

        $validated = $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],

            'phone' => ['nullable', 'string', 'max:20'],
            'country_code' => ['required_with:phone', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],

            'gender' => ['nullable'],

            'dob' => ['nullable'],

            'country' => ['nullable'],

            'state' => ['nullable'],

            'address' => ['nullable'],

            'password' => ['nullable', 'min:6', 'confirmed'],

        ]);



        if (!empty($validated['password'])) {

            $user->password = bcrypt($validated['password']);

        }



        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->phone = isset($validated['phone']) && $validated['phone'] !== ''
            ? PhoneNumber::normalizeLocal($validated['phone'], $validated['country_code'] ?? $user->country_code)
            : $user->phone;
        $user->country_code = $validated['country_code'] ?? $user->country_code;

        $user->gender = $validated['gender'] ?? $user->gender;

        $user->dob = $validated['dob'] ?? $user->dob;

        $user->country = $validated['country'] ?? $user->country;
        
        $user->state = $validated['state'] ?? $user->state;

        $user->address = $validated['address'] ?? $user->address;

        $user->save();



        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');

    }

    

    public function updatePassword(Request $request)

    {

        $user = Auth::user();

        $validated = $request->validate([

            'password' => ['nullable', 'min:6', 'confirmed'],

        ]);



        if (!empty($validated['password'])) {

            $user->password = bcrypt($validated['password']);

        }

        $user->save();



        return redirect()->route('user.profile')->with('success', 'Password updated successfully.');

    }



    public function subscriptions()

    {

        $user = Auth::user();

        $purchases = SubscriptionPurchase::where('user_id', $user->id)

            ->orderByDesc('created_at')

            ->get();

        return view('user.subscription.index', compact('purchases'));

    }



    public function enquiries()

    {

        $user = Auth::user();

        $enquiries = Enquiry::where('user_id', $user->id)

            ->orderByDesc('created_at')

            ->get();

        return view('user.enquiries.index', compact('enquiries'));

    }



    public function orders()

    {

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)

            ->orderByDesc('created_at')

            ->get();

        $sampleOrders = SampleOrder::where('buyer_id', $user->id)
            ->with(['sample', 'material'])
            ->orderByDesc('created_at')
            ->get();

        return view('user.order.index', compact('orders', 'sampleOrders'));

    }

    public function report()
    {
        $user = Auth::user();
        $ordersCount = Order::where('user_id', $user->id)->count();
        $enquiriesCount = Enquiry::where('user_id', $user->id)->count();
        $paymentsTotal = \App\Models\Payment::where('user_id', $user->id)->sum('amount');
        $activeSubscription = SubscriptionPurchase::where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->latest()
            ->first();

        return view('user.report', compact(
            'user',
            'ordersCount',
            'enquiriesCount',
            'paymentsTotal',
            'activeSubscription'
        ));
    }

    public function tracking(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['nullable', 'integer', 'min:1'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
        ]);
        $orderQuery = Order::with(['material', 'supplier', 'manufacturer'])
            ->where('user_id', Auth::id());
        $order = null;

        if (!empty($validated['order_id'])) {
            $order = (clone $orderQuery)->whereKey($validated['order_id'])->first();
        } elseif (!empty($validated['tracking_number'])) {
            $trackingNumber = trim($validated['tracking_number']);
            $hasOrderUid = Schema::hasColumn('orders', 'uid');
            $hasTrackingNumber = Schema::hasColumn('orders', 'tracking_number');
            if ($hasTrackingNumber || $hasOrderUid || ctype_digit($trackingNumber)) {
                $order = (clone $orderQuery)->where(function ($query) use ($trackingNumber, $hasOrderUid, $hasTrackingNumber) {
                    $hasCondition = false;
                    if ($hasTrackingNumber) {
                        $query->where('tracking_number', $trackingNumber);
                        $hasCondition = true;
                    }
                    if ($hasOrderUid) {
                        $hasCondition
                            ? $query->orWhere('uid', strtoupper($trackingNumber))
                            : $query->where('uid', strtoupper($trackingNumber));
                        $hasCondition = true;
                    }
                    if (ctype_digit($trackingNumber)) {
                        $hasCondition
                            ? $query->orWhereKey((int) $trackingNumber)
                            : $query->whereKey((int) $trackingNumber);
                    }
                })->first();
            }
        }

        $orders = (clone $orderQuery)->latest()->limit(50)->get();

        return view('user.tracking', compact('order', 'orders'));
    }

    public function export()
    {
        // Get orders for the logged-in user
        $orders = auth()->user()->orders()->with('payment')->get();

        $filename = 'orders_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['ID', 'Amount', 'Status', 'Payment Status', 'Payment Provider', 'Transaction ID', 'Date'];

        $callback = function() use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $payment = optional($order->payment);

                fputcsv($file, [
                    $order->id,
                    number_format($order->amount ?? 0, 2),
                    ucfirst($order->status ?? '-'),
                    ucfirst($order->payment_status ?? 'pending'),
                    strtoupper($payment->provider ?? '-'),
                    $payment->transaction_id ?? '-',
                    $order->created_at ? $order->created_at->format('d M Y') : '-',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }




    public function payments()

    {

        $user = Auth::user();

        $payments = \App\Models\Payment::where('user_id', $user->id)
            ->with('order')
            ->orderByDesc('created_at')->get();

        return view('user.payment.index', compact('payments'));

    }



    public function payOrder(Request $request, $id)

    {

        $user = Auth::user();

        $order = Order::where('user_id', $user->id)->findOrFail($id);



        // Simulate payment success. Integrate real gateway later.

        $order->payment_status = 'paid';

        $order->status = 'confirmed';

        $order->save();



        \App\Models\Payment::create([

            'user_id' => $user->id,

            'order_id' => $order->id,

            'amount' => $order->amount,

            'status' => 'paid',

            'provider' => 'offline',

            'transaction_id' => 'TXN'.now()->format('YmdHis').$order->id,

            'meta' => null,

        ]);



        return back()->with('success', 'Payment successful. Order confirmed.');

    }



    public function logout(Request $request)

    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');

    }

}





