<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycSubmission;
use App\Models\Manufacturer;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KycReviewController extends Controller
{
    public function document(KycSubmission $kyc, string $field)
    {
        abort_unless(in_array($field, ['identity_document', 'address_document', 'business_document', 'tax_document', 'document_back', 'selfie_document', 'profile_photo'], true), 404);
        $path = $kyc->{$field};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        $mimeType = Storage::disk('local')->mimeType($path) ?: 'application/octet-stream';
        if (str_starts_with($mimeType, 'image/')) {
            return Storage::disk('local')->response(
                $path,
                basename($path),
                ['Content-Type' => $mimeType, 'X-Content-Type-Options' => 'nosniff'],
                'inline'
            );
        }

        return Storage::disk('local')->download($path);
    }

    /**
     * List ALL KYC submissions (pending first, then others) with search + type filter.
     */
    public function index(Request $request)
    {
        $query = KycSubmission::query();

        if ($request->filled('type')) {
            $query->where('account_type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $submissions = $query
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 WHEN status = 'rejected' THEN 1 ELSE 2 END")
            ->latest('submitted_at')
            ->paginate(20)
            ->withQueryString();

        $stats = [
            'total'    => KycSubmission::count(),
            'pending'  => KycSubmission::where('status', 'pending')->count(),
            'approved' => KycSubmission::where('status', 'approved')->count(),
            'rejected' => KycSubmission::where('status', 'rejected')->count(),
        ];

        return view('admin.kyc.index', compact('submissions', 'stats'));
    }

    /**
     * Approve / reject a KYC submission and sync the account status.
     */
    public function decision(Request $request, KycSubmission $kyc)
    {
        $data = $request->validate([
            'decision'   => ['required', 'in:approved,rejected'],
            'admin_note' => ['required_if:decision,rejected', 'nullable', 'string', 'max:2000'],
        ]);

        $kyc->status      = $data['decision'];
        $kyc->admin_note  = $data['admin_note'] ?? null;
        $kyc->reviewed_at = now();
        $kyc->save();

        // KYC approval controls dashboard access through the kyc.approved middleware.
        // Keep accounts active so rejected users can sign in and resubmit documents.
        $model = match ($kyc->account_type) {
            'supplier'     => Supplier::class,
            'manufacturer' => Manufacturer::class,
            default        => User::class,
        };

        $model::whereKey($kyc->account_id)->update(['status' => 1]);

        $label = $data['decision'] === 'approved' ? 'approved' : 'returned for updates';

        // Redirect back to the account detail page if the referrer looks right
        if ($request->filled('redirect_to')) {
            return redirect($request->input('redirect_to'))
                ->with('success', "KYC {$label} successfully.");
        }

        return back()->with('success', "KYC {$label} successfully.");
    }
}
