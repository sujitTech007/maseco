<?php

namespace App\Http\Controllers\Manufacturer;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Support\PhoneNumber;
use Illuminate\Validation\Rule;

class ManufacturerController extends Controller
{
    public function dashboard()
    {
        $manufacturer = Auth::guard('manufacturer')->user();

        $ordersCount = Order::where('manufacturer_id', $manufacturer->id)->count();
        $enquiriesCount = Enquiry::where('manufacturer_id', $manufacturer->id)->count();

        $paymentsTotal = Payment::whereHas('order', function ($query) use ($manufacturer) {
            $query->where('manufacturer_id', $manufacturer->id);
        })->sum('amount');

        return view('manufacturer.dashboard', compact(
            'ordersCount',
            'enquiriesCount',
            'paymentsTotal'
        ));
    }

    public function report()
    {
        $manufacturer = Auth::guard('manufacturer')->user();
        $ordersCount = Order::where('manufacturer_id', $manufacturer->id)->count();
        $completedOrdersCount = Order::where('manufacturer_id', $manufacturer->id)
            ->where('status', 'delivered')->count();
        $enquiriesCount = Enquiry::where('manufacturer_id', $manufacturer->id)->count();
        $paymentsTotal = Payment::whereHas('order', function ($query) use ($manufacturer) {
            $query->where('manufacturer_id', $manufacturer->id);
        })->sum('amount');

        return view('manufacturer.report', compact('ordersCount', 'completedOrdersCount', 'enquiriesCount', 'paymentsTotal'));
    }

    public function shipments(Request $request)
    {
        $manufacturer = Auth::guard('manufacturer')->user();
        $query = Order::with('user')->where('manufacturer_id', $manufacturer->id);

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($builder) use ($search) {
                $builder->where('uid', 'like', '%' . $search . '%')
                    ->orWhere('tracking_number', 'like', '%' . $search . '%')
                    ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', '%' . $search . '%'));
                if (ctype_digit($search)) {
                    $builder->orWhere('id', (int) $search);
                }
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $shipments = $query->latest()->paginate(15)->withQueryString();
        $totalShipments = Order::where('manufacturer_id', $manufacturer->id)->count();
        $pendingShipments = Order::where('manufacturer_id', $manufacturer->id)
            ->whereIn('status', ['pending', 'processing'])->count();
        $inTransitShipments = Order::where('manufacturer_id', $manufacturer->id)
            ->whereIn('status', ['shipped', 'in_transit', 'out_for_delivery'])->count();
        $deliveredShipments = Order::where('manufacturer_id', $manufacturer->id)
            ->where('status', 'delivered')->count();

        return view('manufacturer.shipment', compact(
            'shipments', 'totalShipments', 'pendingShipments', 'inTransitShipments', 'deliveredShipments'
        ));
    }

    public function updateShipment(Request $request, $order)
    {
        $manufacturer = Auth::guard('manufacturer')->user();
        $shipment = Order::where('manufacturer_id', $manufacturer->id)->findOrFail($order);
        $data = $request->validate([
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'shipping_method' => ['nullable', 'string', 'max:100'],
            'estimated_delivery' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,processing,shipped,in_transit,out_for_delivery,delivered,cancelled'],
        ]);
        $shipment->update($data);

        return back()->with('success', 'Shipment updated successfully.');
    }

    public function enquiry()
    {
        return view('manufacturer.enquiry.enquiry');
    }

    public function orders()
    {
        $manufacturer = Auth::guard('manufacturer')->user();
        $sampleOrders = \App\Models\SampleOrder::where('manufacturer_id', $manufacturer->id)
            ->with(['buyer', 'sample', 'material'])->latest()->paginate(15, ['*'], 'sample_orders_page');
        return view('manufacturer.order.orders', compact('sampleOrders'));
    }

    public function plans()
    {
        return redirect()->route('subscription.plan');
    }

    public function payment()
    {
        $manufacturer = Auth::guard('manufacturer')->user();

        $payments = Payment::whereHas('order', function ($query) use ($manufacturer) {
            $query->where('manufacturer_id', $manufacturer->id);
        })->with('order')->orderByDesc('created_at')->get();

        return view('manufacturer.payment.index', compact('payments'));
    }

    public function profile()
    {
        $user = Auth::guard('manufacturer')->user();

        return view('manufacturer.profile.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('manufacturer')->user();

        $request->merge([
            'phone' => PhoneNumber::normalizeLocal(
                (string) $request->input('phone'),
                (string) $request->input('country_code')
            ),
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:manufacturers,email,' . $user->id,
            'country_code' => ['required', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],
            'phone' => [
                'required', 'digits_between:7,15',
                Rule::unique('manufacturers', 'phone')
                    ->where(fn ($query) => $query->where('country_code', $request->input('country_code')))
                    ->ignore($user->id),
            ],
            'company_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country_code = $request->country_code;
        $user->company_name = $request->company_name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('manufacturer.profile')
            ->with('success', 'Profile updated successfully!');
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
        $user->business_type = $request->business_type;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->address = $request->address;
        $user->gst = $request->gst;

        $user->save();

        return redirect()->back()->with(
            'success',
            'Business details updated successfully!'
        );
    }
}
