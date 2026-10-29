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
        $guardRoutes = [
            'supplier'     => 'seller.kyc',
            'manufacturer' => 'manufacturer.kyc',
            'web'          => 'user.kyc',
        ];

        foreach ($guardRoutes as $guard => $kycRoute) {
            $account = Auth::guard($guard)->user();
            if (!$account) continue;

            $type = $guard === 'web' ? 'user' : $guard;
            $kyc  = KycSubmission::where('account_type', $type)->where('account_id', $account->id)->first();

            if (!$kyc || $kyc->status !== 'approved') {
                $message = $kyc?->status === 'rejected'
                    ? 'Your KYC was returned for updates. Please review the admin note and resubmit.'
                    : 'Complete KYC verification to access your dashboard.';

                return redirect()->route($kycRoute)->with('info', $message);
            }

            return $next($request);
        }

        return redirect()->route('login');
    }
}
