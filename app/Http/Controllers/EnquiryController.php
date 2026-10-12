<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Material;

class EnquiryController extends Controller
{
    // public function store(Request $request)
    // {
        
    //     $user = Auth::user();
  
    //     $data = $request->validate([
    //         'material_id' => 'required',
    //         'quantity' => 'required|numeric|min:1',
    //         'expected_price' => 'nullable|numeric|min:0',
    //         'message' => 'nullable|string',
    //     ]);

    //     $material = Material::where('id', $request->material_id)->first();
       
    //     $enquiry = Enquiry::create([
    //         'user_id' => $user->id,
    //         'subject' => 'Quote request for: ' . $material->name,
    //         'message' => ($data['message'] ?? '') . '\nQuantity: ' . $data['quantity'] . '\nExpected price: ' . ($data['expected_price'] ?? 'N/A'),
    //         'status' => 'pending',
            
    //         'material_id' => $material->id,
    //         'supplier_id' => $material->supplier_id,
    //         'manufacturer_id' => $material->manufacturer_id,
    //         'quantity' => $data['quantity'],
    //         'expected_price' => $data['expected_price'] ?? null,
    //     ]);

    //     if ($user->type == 'user') {
    //          return redirect()->route('user.dashboard')->with('success', 'Your enquiry has been submitted.');
    //     }elseif($user->type == 'supplier'){
    //          return redirect()->route('supplier.dashboard')->with('success', 'Your enquiry has been submitted.');
    //     }elseif($user->type == 'manufacturer'){
    //          return redirect()->route('manufacturer.dashboard')->with('success', 'Your enquiry has been submitted.');
    //     }else{
    //     return back()->with('success', 'Your enquiry has been submitted.');
    //     }
    // }
    
    
        public function store(Request $request)
        {
            // Validation
            $data = $request->validate([
                'material_id'     => 'required',
                'quantity'        => 'required|numeric|min:1',
                'expected_price'  => 'nullable|numeric|min:0',
                'message'         => 'nullable|string',
            ]);
        
            // Detect logged-in user by guard
            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
                $redirect = 'user.enquiries';
        
            } elseif (Auth::guard('supplier')->check()) {
                $user = Auth::guard('supplier')->user();
                $redirect = 'supplier.dashboard';
        
            } elseif (Auth::guard('manufacturer')->check()) {
                $user = Auth::guard('manufacturer')->user();
                $redirect = 'manufacturer.dashboard';
        
            } else {
                abort(403, 'Unauthorized');
            }
        
            $material = Material::findOrFail($request->material_id);
        
            Enquiry::create([
                'user_id'          => $user->id,
                'subject'          => $material->name,
                'message'          => ($data['message'] ?? '')
                                      . "\nQuantity: " . $data['quantity']
                                      . "\nExpected price: " . ($data['expected_price'] ?? 'N/A'),
                'status'           => 'pending',
                'material_id'      => $material->id,
                'supplier_id'      => $material->supplier_id,
                'manufacturer_id' => $material->manufacturer_id,
                'quantity'         => $data['quantity'],
                'expected_price'   => $data['expected_price'] ?? null,
            ]);
        
            return redirect()->route($redirect)
                ->with('success', 'Your enquiry has been submitted.');
        }


    public function approveBySupplier(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'quantity' => 'nullable|numeric|min:0',
        ]);

        $enquiry->status = 'approved';
        $enquiry->save();

        Order::create([
            'user_id' => $enquiry->user_id,
            'enquiry_id' => $enquiry->id,
            'supplier_id' => $enquiry->supplier_id,
            'manufacturer_id' => $enquiry->manufacturer_id,
            'material_id' => $enquiry->material_id,
            'quantity' => $validated['quantity'] ?? $enquiry->quantity,
            'amount' => $validated['amount'],
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return back()->with('success', 'Enquiry approved and order generated.');
    }

    public function approveByManufacturer(Request $request, $id)
    {
        return $this->approveBySupplier($request, $id);
    }
}
