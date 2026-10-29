<?php

namespace App\Http\Controllers;

use App\Models\KycSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KycController extends Controller
{
    private function currentAccount(): array
    {
        foreach (['supplier', 'manufacturer', 'web'] as $guard) {
            if ($account = Auth::guard($guard)->user()) {
                return [$account, $guard === 'web' ? 'user' : $guard];
            }
        }
        abort(401);
    }

    // ─── Generic KYC page (legacy / fallback) ────────────────────────────────

    public function show()
    {
        [$account, $type] = $this->currentAccount();
        $kyc = KycSubmission::where('account_type', $type)->where('account_id', $account->id)->first();
        return view('kyc.form', compact('account', 'type', 'kyc'));
    }

    // ─── Seller (Supplier) KYC ───────────────────────────────────────────────

    public function sellerShow()
    {
        $user = Auth::guard('supplier')->user();
        $kyc  = KycSubmission::where('account_type', 'supplier')->where('account_id', $user->id)->first();
        $user->kyc_status = $kyc->status ?? 'not_submitted';
        return view('seller.kyc.index', $this->viewData($user, $kyc, 'supplier'));
    }

    public function sellerSubmit(Request $request)
    {
        $user = Auth::guard('supplier')->user();
        $this->validateSubmission($request, true);
        $this->saveKyc($request, 'supplier', $user->id);
        return redirect()->route('seller.kyc')->with('success', 'Documents submitted for review. You will be notified once approved.');
    }

    // ─── Manufacturer KYC ────────────────────────────────────────────────────

    public function manufacturerShow()
    {
        $user = Auth::guard('manufacturer')->user();
        $kyc  = KycSubmission::where('account_type', 'manufacturer')->where('account_id', $user->id)->first();
        $user->kyc_status = $kyc->status ?? 'not_submitted';
        return view('manufacturer.kyc.index', $this->viewData($user, $kyc, 'manufacturer'));
    }

    public function manufacturerSubmit(Request $request)
    {
        $user = Auth::guard('manufacturer')->user();
        $this->validateSubmission($request, true);
        $this->saveKyc($request, 'manufacturer', $user->id);
        return redirect()->route('manufacturer.kyc')->with('success', 'Documents submitted for review. You will be notified once approved.');
    }

    // ─── Buyer (User) KYC ────────────────────────────────────────────────────

    public function buyerShow()
    {
        $user = Auth::guard('web')->user();
        $kyc  = KycSubmission::where('account_type', 'user')->where('account_id', $user->id)->first();
        $user->kyc_status = $kyc->status ?? 'not_submitted';
        return view('user.kyc.index', $this->viewData($user, $kyc, 'user'));
    }

    public function buyerSubmit(Request $request)
    {
        $user = Auth::guard('web')->user();
        $this->validateSubmission($request, false);
        $this->saveKyc($request, 'user', $user->id);
        return redirect()->route('user.kyc')->with('success', 'Documents submitted for review. You will be notified once approved.');
    }

    // ─── Generic submit (legacy) ─────────────────────────────────────────────

    public function submit(Request $request)
    {
        [$account, $type] = $this->currentAccount();
        $rules = [
            'identity_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'address_document'  => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
        if ($type !== 'user') {
            $rules['business_document'] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'];
            $rules['tax_document']      = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'];
        }
        $request->validate($rules);
        $this->saveKyc($request, $type, $account->id);
        return redirect()->route('kyc.show')->with('success', 'KYC documents submitted. You can access your dashboard after admin approval.');
    }

    // ─── Shared helper ───────────────────────────────────────────────────────

    private function saveKyc(Request $request, string $type, int $accountId): KycSubmission
    {
        $kyc = KycSubmission::firstOrNew(['account_type' => $type, 'account_id' => $accountId]);
        foreach (['identity_document', 'address_document', 'business_document', 'tax_document', 'document_back', 'selfie_document', 'profile_photo'] as $field) {
            if ($request->hasFile($field)) {
                $kyc->{$field} = $request->file($field)->store('kyc/' . $type, 'local');
            }
        }
        $kyc->document_type = $request->input('document_type');
        $kyc->document_number = $request->input('document_number');
        $kyc->form_data = $request->except([
            '_token', '_method', 'identity_document', 'address_document', 'business_document',
            'tax_document', 'document_back', 'selfie_document', 'profile_photo',
        ]);
        $kyc->status       = 'pending';
        $kyc->admin_note   = null;
        $kyc->submitted_at = now();
        $kyc->reviewed_at  = null;
        $kyc->save();
        return $kyc;
    }

    private function validateSubmission(Request $request, bool $business): void
    {
        $category = $business ? 'business' : 'user';
        $documentTypes = config('kyc.document_types.' . $request->input('country') . '.' . $category)
            ?? config('kyc.document_types.default.' . $category, []);
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'country' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:2000'],
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
            'document_type' => ['required', 'string', Rule::in($documentTypes)],
            'document_number' => ['required', 'string', 'max:100'],
            'identity_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'document_back' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'selfie_document' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
            'address_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'business_document' => [$business ? 'required' : 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'tax_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];

        if ($business) {
            $rules += [
                'company_name' => ['required', 'string', 'max:255'],
                'business_type' => ['required', 'in:Manufacturer,Distributor,Supplier,Trader,Other'],
                'company_registration_number' => ['required', 'string', 'max:100'],
                'business_tax_id' => ['required', 'string', 'max:100'],
                'gst_number' => ['nullable', 'string', 'max:100'],
                'business_address' => ['required', 'string', 'max:2000'],
            ];
        }

        $request->validate($rules);
    }

    private function viewData($user, ?KycSubmission $kyc, string $type): array
    {
        $countries = config('kyc.countries', []);
        if ($user->country && !in_array($user->country, $countries, true)) {
            $countries[] = $user->country;
        }

        $country = $kyc?->form_data['country'] ?? $user->country ?? '';
        $documentTypeOptions = config('kyc.document_types', []);
        $accountCategory = $type === 'user' ? 'user' : 'business';
        $documentTypes = $documentTypeOptions[$country][$accountCategory]
            ?? $documentTypeOptions['default'][$accountCategory];

        return compact('user', 'kyc', 'type', 'countries', 'documentTypes', 'documentTypeOptions', 'accountCategory');
    }
}
