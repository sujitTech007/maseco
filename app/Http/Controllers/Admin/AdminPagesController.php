<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\KycSubmission;
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
        $enquiryCount      = Enquiry::count();
        $orderCount        = Order::count();
        $paymentTotal      = Payment::sum('amount');
        $buyerCount        = User::count();
        $sellerCount       = Supplier::count();
        $manufacturerCount = Manufacturer::count();
        $newsletterCount   = Newsletter::count();
        $contactCount      = Contact::count();
        $recentNewsletters = Newsletter::latest()->take(5)->get();
        $recentContacts    = Contact::latest()->take(5)->get();

        // KYC pending counts for dashboard alert
        $kycPendingCount = KycSubmission::where('status', 'pending')->count();

        return view('admin.index', compact(
            'enquiryCount', 'orderCount', 'paymentTotal',
            'buyerCount', 'sellerCount', 'manufacturerCount',
            'newsletterCount', 'contactCount',
            'recentNewsletters', 'recentContacts',
            'kycPendingCount'
        ));
    }

    public function buyer()
    {
        // Eager-load KYC for each buyer (account_type = 'user')
        $users = User::all();
        $kycMap = KycSubmission::where('account_type', 'user')
            ->whereIn('account_id', $users->pluck('id'))
            ->get()
            ->keyBy('account_id');

        return view('admin.buyer.index', compact('users', 'kycMap'));
    }

    public function buyerDetails($id)
    {
        $account = User::findOrFail($id);
        $kyc     = KycSubmission::where('account_type', 'user')->where('account_id', $id)->first();

        return view('admin.accounts.show', [
            'account'     => $account,
            'kyc'         => $kyc,
            'accountType' => 'Buyer',
            'kycType'     => 'user',
            'backRoute'   => 'admin.buyer',
            'icon'        => 'fa-user',
        ]);
    }

    public function seller()
    {
        $suppliers = Supplier::all();
        $kycMap    = KycSubmission::where('account_type', 'supplier')
            ->whereIn('account_id', $suppliers->pluck('id'))
            ->get()
            ->keyBy('account_id');

        return view('admin.supplier.index', compact('suppliers', 'kycMap'));
    }

    public function supplierDetails($id)
    {
        $account = Supplier::findOrFail($id);
        $kyc     = KycSubmission::where('account_type', 'supplier')->where('account_id', $id)->first();

        return view('admin.accounts.show', [
            'account'     => $account,
            'kyc'         => $kyc,
            'accountType' => 'Supplier',
            'kycType'     => 'supplier',
            'backRoute'   => 'admin.seller',
            'icon'        => 'fa-store',
        ]);
    }

    public function manufacturer()
    {
        $manufacturers = Manufacturer::all();
        $kycMap        = KycSubmission::where('account_type', 'manufacturer')
            ->whereIn('account_id', $manufacturers->pluck('id'))
            ->get()
            ->keyBy('account_id');

        return view('admin.manufacturer.index', compact('manufacturers', 'kycMap'));
    }

    public function manufacturerDetails($id)
    {
        $account = Manufacturer::findOrFail($id);
        $kyc     = KycSubmission::where('account_type', 'manufacturer')->where('account_id', $id)->first();

        return view('admin.accounts.show', [
            'account'     => $account,
            'kyc'         => $kyc,
            'accountType' => 'Manufacturer',
            'kycType'     => 'manufacturer',
            'backRoute'   => 'admin.manufacturer',
            'icon'        => 'fa-industry',
        ]);
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
