<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Supplier;

use App\Models\Manufacturer;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use App\Support\PhoneNumber;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class LoginController extends Controller

{

    public function showLoginForm()

    {

        return view('auth.login');
    }



    public function login(Request $request)

    {

        $request->validate([

            'user_type' => 'required|in:user,supplier,manufacturer',

            'phone' => 'required|string|max:30',
            'country_code' => ['required', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],

            'password' => 'required',

        ]);



        $model = $this->getModel($request->user_type);

        $normalizedPhone = PhoneNumber::normalizeLocal($request->phone, $request->country_code);
        $user = $model::where('country_code', $request->country_code)
            ->whereIn('phone', array_unique([$normalizedPhone, $request->phone]))
            ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Invalid credentials or user does not exist..']);
        }

        if ($user->status == 0) {
            return back()->withErrors(['error' => 'Your account is not active, please contact to admin to activate your account.']);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {

            return back()->withErrors(['phone' => 'Invalid credentials.']);
        }



        // Store user id/type in session for OTP verification

        Session::put('otp_user', [

            'id' => $user->id,

            'type' => $request->user_type,

            'phone' => $user->phone,

            'country_code' => $user->country_code,

            'created_at' => now()->timestamp,

        ]);



        if (!$this->sendOtp($user->country_code, $user->phone)) {
            Session::forget('otp_user');

            return back()->withErrors([
                'error' => 'We could not send an OTP right now. Please try again shortly.',
            ]);
        }

        return view('auth.otp')->with('success', 'OTP sent to your phone.');

        // return redirect()->route('otp.form')->with('success', 'OTP sent to your phone.');

    }



    private function sendOtp($countryCode, $phone)
    {
        $accountSid = config('services.twilio.account_sid');
        $authToken = config('services.twilio.auth_token');
        $verifySid = config('services.twilio.verify_sid');

        if (!$accountSid || !$authToken || !$verifySid) {
            return $this->testOtpEnabled();
        }

        $formattedPhone = PhoneNumber::toE164($countryCode, $phone);
        $url = "https://verify.twilio.com/v2/Services/{$verifySid}/Verifications";

        try {
            $response = Http::asForm()
                ->withBasicAuth($accountSid, $authToken)
                ->timeout(10)
                ->post($url, [
                    'To' => $formattedPhone,
                    'Channel' => 'sms',
                ]);

            return $response->successful() || $this->testOtpEnabled();
        } catch (ConnectionException $exception) {
            Log::warning('Twilio OTP request failed to connect.', [
                'environment' => app()->environment(),
            ]);

            return $this->testOtpEnabled();
        }
    }

    private function testOtpEnabled(): bool
    {
        return app()->environment(['local', 'testing'])
            && (bool) config('services.twilio.test_otp_enabled');
    }

    private function verifyOtp(string $countryCode, string $phone, string $otp): bool
    {
        $testOtp = (string) config('services.twilio.test_otp', '112233');
        if ($this->testOtpEnabled() && hash_equals($testOtp, $otp)) {
            return true;
        }

        $accountSid = config('services.twilio.account_sid');
        $authToken = config('services.twilio.auth_token');
        $verifySid = config('services.twilio.verify_sid');
        if (!$accountSid || !$authToken || !$verifySid) {
            return false;
        }

        $formattedPhone = PhoneNumber::toE164($countryCode, $phone);
        $url = "https://verify.twilio.com/v2/Services/{$verifySid}/VerificationCheck";

        try {
            $response = Http::asForm()
                ->withBasicAuth($accountSid, $authToken)
                ->timeout(10)
                ->post($url, [
                    'To' => $formattedPhone,
                    'Code' => $otp,
                ]);

            return $response->successful()
                && $response->json('status') === 'approved';
        } catch (ConnectionException $exception) {
            Log::warning('Twilio OTP verification failed to connect.', [
                'environment' => app()->environment(),
            ]);

            return false;
        }
    }



    public function otpForm()

    {

        return view('auth.otp');
    }



    public function otpVerify(Request $request)
    {
        $otp = $request->otp ?: collect([
            $request->otp1,
            $request->otp2,
            $request->otp3,
            $request->otp4,
            $request->otp5,
            $request->otp6
        ])->implode('');

        if (!preg_match('/^\d{6}$/', $otp)) {
            return back()->with('error', 'Please enter a valid 6-digit OTP.');
        }

        $otpUser = Session::get('otp_user');
        if (!$otpUser) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        if (now()->timestamp - (int) ($otpUser['created_at'] ?? 0) > 600) {
            Session::forget('otp_user');
            return redirect()->route('login')->with('error', 'Your OTP session expired. Please login again.');
        }

        if (!$this->verifyOtp(
            $otpUser['country_code'] ?? '+1',
            $otpUser['phone'],
            $otp
        )) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        // Login user
        $model = $this->getModel($otpUser['type']);
        $user = $model::find($otpUser['id']);
        Session::forget('otp_user');

        if (!$user || $user->status == 0) {
            return redirect()->route('login')->withErrors([
                'error' => 'Your account is not active or could not be found.',
            ]);
        }

        if ($otpUser['type'] === 'user') {
            Auth::guard('web')->login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'))->with('success', 'Login successful!');
        } elseif ($otpUser['type'] === 'supplier') {
            Auth::guard('supplier')->login($user);
            $request->session()->regenerate();
            return redirect()->route('seller.dashboard')->with('success', 'Login successful!');
        } else {
            Auth::guard('manufacturer')->login($user);
            $request->session()->regenerate();
            return redirect()->route('manufacturer.dashboard')->with('success', 'Login successful!');
        }
    }



    private function getModel($type)

    {

        if ($type === 'user') return User::class;

        if ($type === 'supplier') return Supplier::class;

        return Manufacturer::class;
    }
}
