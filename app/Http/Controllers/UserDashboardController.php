<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Order;

use Illuminate\Support\Facades\Response;

use App\Models\Enquiry;

use App\Models\SubscriptionPurchase;



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

        $validated = $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],

            'phone' => ['nullable', 'string', 'max:20'],

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

        $user->phone = $validated['phone'] ?? $user->phone;

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

        return view('user.order.index', compact('orders'));

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





