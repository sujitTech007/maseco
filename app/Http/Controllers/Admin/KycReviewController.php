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
        abort_unless(in_array($field, ['identity_document', 'address_document', 'business_document', 'tax_document'], true), 404);
        $path = $kyc->{$field};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path);
    }

    public function index()
    {
        $submissions = KycSubmission::whereIn('status', ['pending', 'rejected'])
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->latest('submitted_at')->paginate(20);

        return view('admin.kyc.index', compact('submissions'));
    }

    public function decision(Request $request, KycSubmission $kyc)
    {
        $data = $request->validate([
            'decision' => ['required', 'in:approved,rejected'],
            'admin_note' => ['required_if:decision,rejected', 'nullable', 'string', 'max:2000'],
        ]);

        $kyc->status = $data['decision'];
        $kyc->admin_note = $data['admin_note'] ?? null;
        $kyc->reviewed_at = now();
        $kyc->save();

        if ($data['decision'] === 'approved') {
            $model = match ($kyc->account_type) {
                'supplier' => Supplier::class,
                'manufacturer' => Manufacturer::class,
                default => User::class,
            };
            $model::whereKey($kyc->account_id)->update(['status' => 1]);
        }

        return back()->with('success', 'KYC ' . $data['decision'] . ' successfully.');
    }
}
