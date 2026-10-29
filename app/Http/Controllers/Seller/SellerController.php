<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Support\PhoneNumber;
use Illuminate\Validation\Rule;


class SellerController extends Controller
{
    public function dashboard()
    {
        $supplier = Auth::guard('supplier')->user();
        $ordersCount = \App\Models\Order::where('supplier_id', $supplier->id)->count();
        $enquiriesCount = \App\Models\Enquiry::where('supplier_id', $supplier->id)->count();
        $paymentsTotal = \App\Models\Payment::whereHas('order', function($q) use ($supplier){ $q->where('supplier_id', $supplier->id); })->sum('amount');
        $paidOrdersCount = \App\Models\Order::where('supplier_id', $supplier->id)->where('payment_status', 'paid')->count();
        return view('seller.dashboard', compact('ordersCount', 'paidOrdersCount', 'enquiriesCount', 'paymentsTotal'));
    }

    public function enquiry()
    {
        return view('seller.enquiry.index');
    }

    public function report()
    {
        $supplier = Auth::guard('supplier')->user();
        $ordersCount = \App\Models\Order::where('supplier_id', $supplier->id)->count();
        $paidOrdersCount = \App\Models\Order::where('supplier_id', $supplier->id)->where('payment_status', 'paid')->count();
        $enquiriesCount = \App\Models\Enquiry::where('supplier_id', $supplier->id)->count();
        $paymentsTotal = \App\Models\Payment::whereHas('order', function ($query) use ($supplier) {
            $query->where('supplier_id', $supplier->id);
        })->sum('amount');

        return view('seller.report', compact('ordersCount', 'paidOrdersCount', 'enquiriesCount', 'paymentsTotal'));
    }

    public function tracking(Request $request)
    {
        return $this->trackingPage($request);
    }

    public function trackingOrder(Request $request, $order)
    {
        $request->merge(['search' => $order]);
        return $this->trackingPage($request);
    }

    private function trackingPage(Request $request)
    {
        $supplier = Auth::guard('supplier')->user();
        $query = \App\Models\Order::with('user')->where('supplier_id', $supplier->id);
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($builder) use ($search) {
                $builder->where('uid', 'like', '%' . $search . '%')
                    ->orWhere('tracking_number', 'like', '%' . $search . '%')
                    ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', '%' . $search . '%'));
                if (ctype_digit($search)) $builder->orWhere('id', (int) $search);
            });
        }
        if ($request->filled('status')) $query->where('status', $request->input('status'));

        $ordersCount = \App\Models\Order::where('supplier_id', $supplier->id)->count();
        $inTransitCount = \App\Models\Order::where('supplier_id', $supplier->id)->whereIn('status', ['shipped', 'in_transit', 'out_for_delivery'])->count();
        $deliveredCount = \App\Models\Order::where('supplier_id', $supplier->id)->where('status', 'delivered')->count();
        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('seller.tracking', compact('orders', 'ordersCount', 'inTransitCount', 'deliveredCount'));
    }

    public function shipments(Request $request)
    {
        $supplier = Auth::guard('supplier')->user();
        $query = \App\Models\Order::with('user')->where('supplier_id', $supplier->id);
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($builder) use ($search) {
                $builder->where('uid', 'like', '%' . $search . '%')
                    ->orWhere('tracking_number', 'like', '%' . $search . '%')
                    ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', '%' . $search . '%'));
                if (ctype_digit($search)) $builder->orWhere('id', (int) $search);
            });
        }
        if ($request->filled('status')) $query->where('status', $request->input('status'));

        $shipments = $query->latest()->paginate(15)->withQueryString();
        $shipmentsCount = \App\Models\Order::where('supplier_id', $supplier->id)->count();
        $pendingShipmentsCount = \App\Models\Order::where('supplier_id', $supplier->id)->whereIn('status', ['pending', 'processing'])->count();
        $inTransitCount = \App\Models\Order::where('supplier_id', $supplier->id)->whereIn('status', ['shipped', 'in_transit', 'out_for_delivery'])->count();
        $deliveredCount = \App\Models\Order::where('supplier_id', $supplier->id)->where('status', 'delivered')->count();

        return view('seller.shipment', compact('shipments', 'shipmentsCount', 'pendingShipmentsCount', 'inTransitCount', 'deliveredCount'));
    }

    public function updateShipment(Request $request, $order)
    {
        $supplier = Auth::guard('supplier')->user();
        $shipment = \App\Models\Order::where('supplier_id', $supplier->id)->findOrFail($order);
        $data = $request->validate([
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'shipping_method' => ['nullable', 'string', 'max:100'],
            'estimated_delivery' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,processing,shipped,in_transit,out_for_delivery,delivered,cancelled'],
        ]);
        $shipment->update($data);

        return back()->with('success', 'Shipment updated successfully.');
    }

    public function material()
    {
        return view('seller.material.index');
    }
    public function addMaterial()
    {
        return view('seller.material.create');
    }
    public function createMaterial()
    {
        return view('seller.material.create');
    }
    public function storeMaterial(Request $request)
    {
        // Validate and store the material data
        // For now, just redirect back to the material listing
        return redirect()->route('seller.material')->with('success', 'Material added successfully!');
    }
    public function editMaterial($id)
    {
        // Fetch material by $id and pass to the view
        return view('seller.material.edit', compact('id'));
    }
    public function showMaterial($id)
    {
        // Fetch material by $id and pass to the view
        return view('seller.material.show', compact('id'));
    }
    public function updateMaterial(Request $request, $id)
    {
        // Validate and update the material data by $id
        // For now, just redirect back to the material listing
        return redirect()->route('seller.material')->with('success', 'Material updated successfully!');
    }
    public function deleteMaterial($id)
    {
        // Delete the material by $id
        // For now, just redirect back to the material listing
        return redirect()->route('seller.material')->with('success', 'Material deleted successfully!');
    }


    public function orders()
    {
        $supplier = Auth::guard('supplier')->user();
        $sampleOrders = \App\Models\SampleOrder::where('supplier_id', $supplier->id)
            ->with(['buyer', 'sample', 'material'])->latest()->paginate(15, ['*'], 'sample_orders_page');
        return view('seller.order.index', compact('sampleOrders'));
    }

    public function plans()
    {
        return redirect()->route('subscription.plan');
    }

    public function payment()
    {
        $supplier = Auth::guard('supplier')->user();
        $payments = \App\Models\Payment::whereHas('order', function($q) use ($supplier){
            $q->where('supplier_id', $supplier->id);
        })->with('order')->orderByDesc('created_at')->get();
        return view('seller.payment.index', compact('payments'));
    }

    public function profile()
    {
        $user = Auth::guard('supplier')->user();
        return view('seller.profile.index', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('supplier')->user();

        $request->merge([
            'phone' => PhoneNumber::normalizeLocal(
                (string) $request->input('phone'),
                (string) $request->input('country_code')
            ),
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $user->id,
            'country_code' => ['required', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],
            'phone' => [
                'required', 'digits_between:7,15',
                Rule::unique('suppliers', 'phone')
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
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('seller.profile')->with('success', 'Profile updated successfully!');
    }

    public function updateBusiness(Request $request)
    {
        $user = Auth::guard('supplier')->user();
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'address' => 'required|string|max:500',
            'gst' => 'nullable|string|max:50',
        ]);

        // Assuming Supplier has these columns; if not, add migration/adjust as needed
        $user->company_name = $request->business_name;
        $user->business_type = $request->business_type ?? $user->business_type;
        $user->country = $request->country ?? $user->country;
        $user->state = $request->state ?? $user->state;
        $user->address = $request->address ?? $user->address;
        $user->gst = $request->gst ?? $user->gst;
        $user->save();

        return redirect()->route('seller.profile')->with('success', 'Business details updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::guard('supplier')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
