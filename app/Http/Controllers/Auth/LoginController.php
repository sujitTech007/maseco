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

use Illuminate\Contracts\Auth\Authenticatable;



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
        
        if(!$user){
            return back()->withErrors(['error' => 'Invalid credentials or user does not exist..']);
        }
        
        if($user->status == 0){
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

        ]);



        $this->sendOtp($user->country_code, $user->phone);

        return view('auth.otp')->with('success', 'OTP sent to your phone.');

        // return redirect()->route('otp.form')->with('success', 'OTP sent to your phone.');

    }



    private function sendOtp($countryCode, $phone)
{
    $accountSid = env('TWILIO_ACCOUNT_SID');
    $authToken  = env('TWILIO_AUTH_TOKEN');
    $verifySid  = env('TWILIO_VERIFY_SID');

    // Build full phone number dynamically
    $formattedPhone = PhoneNumber::toE164($countryCode, $phone);

    $url = "https://verify.twilio.com/v2/Services/{$verifySid}/Verifications";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'To' => $formattedPhone,
        'Channel' => 'sms'
    ]));
    curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}



    public function otpForm()

    {

        return view('auth.otp');

    }



    public function otpVerify(Request $request)
{
    $otp = $request->otp ?: collect([
        $request->otp1, $request->otp2, $request->otp3, 
        $request->otp4, $request->otp5, $request->otp6
    ])->implode('');

    if (!preg_match('/^\d{6}$/', $otp)) {
        return back()->with('error', 'Please enter a valid 6-digit OTP.');
    }

    $otpUser = Session::get('otp_user');
    if (!$otpUser) {
        return redirect()->route('login')->with('error', 'Session expired. Please login again.');
    }

    $accountSid = env('TWILIO_ACCOUNT_SID');
    $authToken  = env('TWILIO_AUTH_TOKEN');
    $verifySid  = env('TWILIO_VERIFY_SID');

    // Use stored country code here too
    $formattedPhone = PhoneNumber::toE164($otpUser['country_code'] ?? '+1', $otpUser['phone']);

    $url = "https://verify.twilio.com/v2/Services/{$verifySid}/VerificationCheck";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'To'   => $formattedPhone,
        'Code' => $otp
    ]));
    curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");
    $response = curl_exec($ch);
    $twilioResponse = json_decode($response, true);
    curl_close($ch);

    if (!isset($twilioResponse['status']) || $twilioResponse['status'] !== 'approved') {
        return back()->with('error', 'Invalid or expired OTP.');
    }

    // Login user
    $model = $this->getModel($otpUser['type']);
    $user = $model::find($otpUser['id']);
    Session::forget('otp_user');

    if ($otpUser['type'] === 'user') {
        Auth::guard('web')->login($user);
        return redirect()->route('user.dashboard')->with('success', 'Login successful!');
    } elseif ($otpUser['type'] === 'supplier') {
        Auth::guard('supplier')->login($user);
        return redirect()->route('seller.dashboard')->with('success', 'Login successful!');
    } else {
        Auth::guard('manufacturer')->login($user);
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

