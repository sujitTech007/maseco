<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Schema;

class AdminPagesController extends Controller
{
    public function dashboard()
    {
        $enquiryCount = Enquiry::count();
        $orderCount = Order::count();
        $paymentTotal = Payment::sum('amount');
        $buyerCount = User::count();
        $sellerCount = Supplier::count();
        $manufacturerCount = Manufacturer::count();
        $newsletterCount = Newsletter::count();
        $contactCount = Contact::count();
        $recentNewsletters = Newsletter::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.index', compact(
            'enquiryCount',
            'orderCount',
            'paymentTotal',
            'buyerCount',
            'sellerCount',
            'manufacturerCount',
            'newsletterCount',
            'contactCount',
            'recentNewsletters',
            'recentContacts'
        ));
    }

    public function buyer()
    {
        $users = User::all();

        return view('admin.buyer.index', compact('users'));
    }

    public function seller()
    {
        $suppliers = Supplier::all();

        return view('admin.supplier.index', compact('suppliers'));
    }

    public function manufacturer()
    {
        $manufacturers = Manufacturer::all();

        return view('admin.manufacturer.index', compact('manufacturers'));
    }

    public function service()
    {
        return view('admin.service');
    }

    public function orders()
    {
        $orders = Order::with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function tracking(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $hasTrackingNumber = Schema::hasColumn('orders', 'tracking_number');
        $hasOrderUid = Schema::hasColumn('orders', 'uid');
        $ordersQuery = Order::with(['user', 'material', 'supplier', 'manufacturer'])
            ->orderByDesc('created_at');

        if (!empty($filters['status'])) {
            $ordersQuery->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $ordersQuery->where(function ($query) use ($search, $hasTrackingNumber, $hasOrderUid) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
                if ($hasTrackingNumber) {
                    $query->orWhere('tracking_number', 'like', '%' . $search . '%');
                }
                if ($hasOrderUid) {
                    $query->orWhere('uid', 'like', '%' . $search . '%');
                }
                if (ctype_digit($search)) {
                    $query->orWhereKey((int) $search);
                }
            });
        }

        $orders = $ordersQuery->paginate(20)->withQueryString();
        $totalOrders = Order::count();
        $inTransitOrders = Order::whereIn('status', ['shipped', 'in_transit', 'out_for_delivery'])->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $untrackedOrders = $hasTrackingNumber
            ? Order::whereNull('tracking_number')->orWhere('tracking_number', '')->count()
            : $totalOrders;

        return view('admin.tracking.index', compact(
            'orders', 'totalOrders', 'inTransitOrders', 'deliveredOrders', 'untrackedOrders'
        ));
    }

    public function plan()
    {
        return view('admin.plan');
    }

    public function enquiry()
    {
        $enquiries = Enquiry::with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function payment()
    {
        $payments = Payment::with(['order', 'order.user'])
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
        $user = User::findOrFail($id);
        $user->status = $request->input('status') ? 1 : 0;
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status,
        ]);
    }

    public function toggleSellerStatus(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->status = $request->input('status') ? 1 : 0;
        $supplier->save();

        return response()->json([
            'success' => true,
            'status' => $supplier->status,
        ]);
    }

    public function toggleManufacturerStatus(Request $request, $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->status = $request->input('status') ? 1 : 0;
        $manufacturer->save();

        return response()->json([
            'success' => true,
            'status' => $manufacturer->status,
        ]);
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
