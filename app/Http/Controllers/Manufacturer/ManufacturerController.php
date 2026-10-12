<?php



namespace App\Http\Controllers\Manufacturer;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class ManufacturerController extends Controller

{

    public function dashboard()

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $ordersCount = \App\Models\Order::where('manufacturer_id', $manufacturer->id)->count();

        $enquiriesCount = \App\Models\Enquiry::where('manufacturer_id', $manufacturer->id)->count();

        $paymentsTotal = \App\Models\Payment::whereHas('order', function($q) use ($manufacturer){ $q->where('manufacturer_id', $manufacturer->id); })->sum('amount');

        return view('manufacturer.dashboard', compact('ordersCount', 'enquiriesCount', 'paymentsTotal'));

    }



    public function enquiry()

    {

        return view('manufacturer.enquiry');

    }



    public function orders()

    {

        return view('manufacturer.orders');

    }



    public function plans()

    {

        return view('manufacturer.plans');

    }



    public function payment()

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $payments = \App\Models\Payment::whereHas('order', function($q) use ($manufacturer){

            $q->where('manufacturer_id', $manufacturer->id);

        })->orderByDesc('created_at')->get();

        return view('manufacturer.payment.index', compact('payments'));

    }



    public function profile()

    {

        $user = Auth::guard('manufacturer')->user();

        return view('manufacturer.profile', compact('user'));

    }



    public function updateProfile(Request $request)

    {

        $user = Auth::guard('manufacturer')->user();

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:manufacturers,email,' . $user->id,

            'phone' => 'required|string|unique:manufacturers,phone,' . $user->id,

            'company_name' => 'required|string|max:255',

            'password' => 'nullable|string|min:6|confirmed',

        ]);



        $user->name = $request->name;

        $user->email = $request->email;

        $user->phone = $request->phone;

        $user->company_name = $request->company_name;

        if ($request->filled('password')) {

            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);

        }

        $user->save();



        return redirect()->route('manufacturer.profile')->with('success', 'Profile updated successfully!');

    }



    public function logout(Request $request)

    {

        Auth::guard('manufacturer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');

    }



    public function updateBusiness(Request $request)

    {

        $user = Auth::guard('manufacturer')->user();

        $request->validate([

            'business_name' => 'required|string|max:255',

            'business_type' => 'required|string|max:100',

            'country' => 'required|string|max:100',

            'state' => 'required|string|max:100',

            'address' => 'required|string|max:500',

            'gst' => 'nullable|string|max:50',

        ]);



        $user->company_name = $request->business_name;

        $user->business_type = $request->business_type ?? $user->business_type;

        $user->country = $request->country ?? $user->country;

        $user->state = $request->state ?? $user->state;

        $user->address = $request->address ?? $user->address;

        $user->gst = $request->gst ?? $user->gst;

        $user->save();



        return redirect()->back()->with('success', 'Business details updated successfully!');

    }

}





