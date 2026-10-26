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
