<?php

namespace App\Http\Middleware;

use App\Models\KycSubmission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureKycApproved
{
    public function handle(Request $request, Closure $next)
    {
        foreach (['supplier', 'manufacturer', 'web'] as $guard) {
            $account = Auth::guard($guard)->user();
            if (!$account) continue;

            $type = $guard === 'web' ? 'user' : $guard;
            $kyc = KycSubmission::where('account_type', $type)->where('account_id', $account->id)->first();
            if (!$kyc || $kyc->status !== 'approved') {
                return redirect()->route('kyc.show')->with('info', $kyc?->status === 'rejected'
                    ? 'Your KYC was returned for updates. Please review the admin note and resubmit.'
                    : 'Complete KYC and wait for admin approval to access your dashboard.');
            }
            return $next($request);
        }

        return redirect()->route('login');
    }
}
