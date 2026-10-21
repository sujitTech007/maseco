<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Manufacturer;
use App\Support\PhoneNumber;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'user_type' => 'required|in:user,supplier,manufacturer',
            'phone' => 'required|string',
            'country_code' => ['required', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],
        ]);

        $model = $this->getModel($validated['user_type']);
        $normalizedPhone = PhoneNumber::normalizeLocal($validated['phone'], $validated['country_code']);
        $user = $model::where('country_code', $validated['country_code'])
            ->whereIn('phone', array_unique([$normalizedPhone, $validated['phone']]))
            ->first();
        if (!$user) {
            return back()->withErrors(['phone' => 'No account found with this phone number.'])->withInput();
        }

        Session::put('reset_user', [
            'id' => $user->id,
            'type' => $validated['user_type'],
            'phone' => $user->phone,
            'country_code' => $user->country_code,
        ]);

        $this->sendOtpViaTwilio($user->country_code, $user->phone);
        return redirect()->route('password.otp.form')->with('success', 'OTP sent to your phone.');
    }

    public function otpForm()
    {
        if (!Session::get('reset_user')) {
            return redirect()->route('password.forgot')->with('error', 'Session expired. Please try again.');
        }
        return view('auth.otp-reset');
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->otp ?: collect([$request->otp1, $request->otp2, $request->otp3, $request->otp4, $request->otp5, $request->otp6])->implode('');
        if (!preg_match('/^\d{6}$/', $otp)) {
            return back()->withErrors(['otp' => 'Please enter a valid 6-digit OTP.']);
        }
        $resetUser = Session::get('reset_user');
        if (!$resetUser) {
            return redirect()->route('password.forgot')->with('error', 'Session expired. Please try again.');
        }
        if (!$this->verifyOtpWithTwilio($resetUser['country_code'] ?? '+1', $resetUser['phone'], $otp)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
        Session::put('reset_user_verified', true);
        return redirect()->route('password.reset.form');
    }

    public function resetForm()
    {
        if (!Session::get('reset_user') || !Session::get('reset_user_verified')) {
            return redirect()->route('password.forgot');
        }
        return view('auth.reset');
    }

    public function reset(Request $request)
    {
        if (!Session::get('reset_user') || !Session::get('reset_user_verified')) {
            return redirect()->route('password.forgot');
        }
        $data = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $resetUser = Session::get('reset_user');
        $model = $this->getModel($resetUser['type']);
        $user = $model::find($resetUser['id']);
        if (!$user) {
            return redirect()->route('password.forgot')->with('error', 'Account not found.');
        }
        $user->password = Hash::make($data['password']);
        $user->save();
        Session::forget(['reset_user', 'reset_user_verified']);
        return redirect()->route('login')->with('success', 'Password updated. Please login.');
    }

    private function getModel(string $type)
    {
        if ($type === 'user') return User::class;
        if ($type === 'supplier') return Supplier::class;
        return Manufacturer::class;
    }

    private function sendOtpViaTwilio(string $countryCode, string $phone)
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken  = env('TWILIO_AUTH_TOKEN');
        $verifySid  = env('TWILIO_VERIFY_SID');
        $phone = PhoneNumber::toE164($countryCode, $phone);
        $url = "https://verify.twilio.com/v2/Services/{$verifySid}/Verifications";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['To' => $phone, 'Channel' => 'sms']));
        curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");
        curl_exec($ch);
        curl_close($ch);
    }

    private function verifyOtpWithTwilio(string $countryCode, string $phone, string $otp): bool
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken  = env('TWILIO_AUTH_TOKEN');
        $verifySid  = env('TWILIO_VERIFY_SID');
        $phone = PhoneNumber::toE164($countryCode, $phone);
        $url = "https://verify.twilio.com/v2/Services/{$verifySid}/VerificationCheck";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['To' => $phone, 'Code' => $otp]));
        curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");
        $response = curl_exec($ch);
        curl_close($ch);
        $twilioResponse = json_decode($response, true);
        return isset($twilioResponse['status']) && $twilioResponse['status'] === 'approved';
    }
}


