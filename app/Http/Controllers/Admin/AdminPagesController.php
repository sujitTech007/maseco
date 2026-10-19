<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Contact;

class AdminPagesController extends Controller

{

    public function dashboard()

    {

        $enquiryCount = \App\Models\Enquiry::count();

        $orderCount = \App\Models\Order::count();

        $paymentTotal = \App\Models\Payment::sum('amount');

        $buyerCount = \App\Models\User::count();

        $sellerCount = \App\Models\Supplier::count();

        $manufacturerCount = \App\Models\Manufacturer::count();

        return view('admin.index', compact('enquiryCount', 'orderCount', 'paymentTotal', 'buyerCount', 'sellerCount', 'manufacturerCount'));

    }



    public function buyer()

    {

        $users = \App\Models\User::all();

        return view('admin.user.index', compact('users'));

    }



    public function seller()

    {

        $suppliers = \App\Models\Supplier::all();

        return view('admin.supplier.index', compact('suppliers'));

    }

    public function manufacturer()

    {

        $manufacturers = \App\Models\Manufacturer::all();

        return view('admin.manufacturer.index', compact('manufacturers'));

    }



    public function service()

    {

        return view('admin.service');

    }



    public function orders()

    {

        $orders = \App\Models\Order::with(['user'])

            ->orderByDesc('created_at')

            ->get();

        return view('admin.orders.index', compact('orders'));

    }



    public function plan()

    {

        return view('admin.plan');

    }



    public function enquiry()

    {

        $enquiries = \App\Models\Enquiry::with(['user'])

            ->orderByDesc('created_at')

            ->get();

        return view('admin.enquiry.index', compact('enquiries'));

    }



    public function payment()

    {

        $payments = \App\Models\Payment::with(['order', 'order.user'])

            ->orderByDesc('created_at')

            ->get();

        return view('admin.payment.index', compact('payments'));

    }



    public function profile()

    {

        return view('admin.profile.index');

    }



    public function toggleBuyerStatus(Request $request, $id)

    {

        $user = \App\Models\User::findOrFail($id);

        $user->status = $request->input('status') ? 1 : 0;

        $user->save();

        return response()->json(['success' => true, 'status' => $user->status]);

    }



    public function toggleSellerStatus(Request $request, $id)

    {

        $supplier = \App\Models\Supplier::findOrFail($id);

        $supplier->status = $request->input('status') ? 1 : 0;

        $supplier->save();

        return response()->json(['success' => true, 'status' => $supplier->status]);

    }



    public function toggleManufacturerStatus(Request $request, $id)

    {

        $manufacturer = \App\Models\Manufacturer::findOrFail($id);

        $manufacturer->status = $request->input('status') ? 1 : 0;

        $manufacturer->save();

        return response()->json(['success' => true, 'status' => $manufacturer->status]);

    }

    public function newsletterList()
    {
        $newsletters = Newsletter::all();
        return view('admin.newsletter.index', compact('newsletters'));
    }

    public function contactList()
    {
        $contacts = Contact::all();
        return view('admin.contact', compact('contacts'));
    }

}

