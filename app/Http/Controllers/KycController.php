<?php

namespace App\Http\Controllers;

use App\Models\KycSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function show()
    {
        [$account, $type] = $this->currentAccount();
        $kyc = KycSubmission::where('account_type', $type)->where('account_id', $account->id)->first();
        return view('kyc.form', compact('account', 'type', 'kyc'));
    }

    public function submit(Request $request)
    {
        [$account, $type] = $this->currentAccount();
        $rules = [
            'identity_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'address_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
        if ($type !== 'user') {
            $rules['business_document'] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'];
            $rules['tax_document'] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'];
        }
        $request->validate($rules);

        $kyc = KycSubmission::firstOrNew(['account_type' => $type, 'account_id' => $account->id]);
        foreach (['identity_document', 'address_document', 'business_document', 'tax_document'] as $field) {
            if ($request->hasFile($field)) $kyc->{$field} = $request->file($field)->store('kyc/' . $type, 'local');
        }
        $kyc->status = 'pending';
        $kyc->admin_note = null;
        $kyc->submitted_at = now();
        $kyc->reviewed_at = null;
        $kyc->save();

        return redirect()->route('kyc.show')->with('success', 'KYC documents submitted. You can access your dashboard after admin approval.');
    }
}
