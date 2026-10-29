<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Supplier;

use App\Models\Manufacturer;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Support\PhoneNumber;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class RegisterController extends Controller

{

    public function showRegistrationForm()

    {

        return view('auth.sign-up');

    }



    // public function register(Request $request)

    // {

    //     $request->validate([

    //         'user_type' => 'required|in:user,supplier,manufacturer',

    //         'name' => 'required',

    //         'email' => 'required|email',

    //         'phone' => 'required|string',

    //         'password' => 'required|confirmed|min:6',

    //     ]);



    //     $data = [

    //         'name' => $request->name,

    //         'email' => $request->email,

    //         'phone' => $request->phone,
            
    //         'country_code' => $request->country_code,

    //         'password' => Hash::make($request->password),

    //     ];



    //     if ($request->user_type === 'user') {

    //         $data['name'] = $request->name;

    //         $user = User::create($data);

    //     } elseif ($request->user_type === 'supplier') {

    //         $data['company_name'] = $request->company_name;

    //         $user = Supplier::create($data);

    //     } else {

    //         $data['company_name'] = $request->company_name;

    //         $user = Manufacturer::create($data);

    //     }



    //     // No OTP on registration, just redirect to login

    //     return redirect()->route('login')->with('success', 'Registration successful! Please login.');

    // }


    public function register(Request $request)
{
    $request->merge([
        'phone' => PhoneNumber::normalizeLocal(
            (string) $request->input('phone'),
            (string) $request->input('country_code')
        ),
    ]);

    $request->validate([
        'user_type' => 'required|in:user,supplier,manufacturer',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|digits_between:7,15',
        'country_code' => ['required', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],
        'password' => 'required|confirmed|min:6',
        // 'country_code' => 'required',
    ]);

    $phone = PhoneNumber::normalizeLocal($request->phone);
    $countryCode = $request->country_code;

    $emailExists = User::where('email', $request->email)->exists() ||
                   Supplier::where('email', $request->email)->exists() ||
                   Manufacturer::where('email', $request->email)->exists();

    $phoneExists = User::where('phone', $phone)->where('country_code', $countryCode)->exists() ||
                    Supplier::where('phone', $phone)->where('country_code', $countryCode)->exists() ||
                    Manufacturer::where('phone', $phone)->where('country_code', $countryCode)->exists();

    if ($emailExists) {
        return back()->withErrors(['email' => 'User already exist with given email id.'])->withInput();
    }

    if ($phoneExists) {
        return back()->withErrors(['phone' => 'User already exist with given mobile number.'])->withInput();
    }

    // Select model based on user type
    switch ($request->user_type) {
        case 'user':
            $model = User::class;
            break;
        case 'supplier':
            $model = Supplier::class;
            break;
        case 'manufacturer':
            $model = Manufacturer::class;
            break;
        default:
            return back()->withErrors(['user_type' => 'Invalid user type.'])->withInput();
    }

    // // Check duplicates only in selected model
    // if ($model::where('email', $request->email)->exists()) {
    //     return back()->withErrors(['email' => 'User already exist with given email id.'])->withInput();
    // }

    // if ($model::where('phone', $request->phone)->exists()) {
    //     return back()->withErrors(['phone' => 'User already exist with given mobile number.'])->withInput();
    // }

    // Prepare user data
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $phone,
        'country_code' => $countryCode,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'status' => 1,
    ];

    // Add company name if needed
    if (in_array($request->user_type, ['supplier', 'manufacturer'])) {
        $data['company_name'] = $request->company_name;
    }

    // Create user
    $user = $model::create($data);

    try {
        Mail::to($user->email)->send(new WelcomeMail($user, $request->user_type));
    } catch (\Throwable $exception) {
        Log::error('Welcome email could not be sent.', ['email' => $user->email, 'exception' => $exception->getMessage()]);
    }

    // Sign in immediately so KYC is the first page after registration.
    $guard = match ($request->user_type) {
        'supplier' => 'supplier',
        'manufacturer' => 'manufacturer',
        default => 'web',
    };
    Auth::guard($guard)->login($user);
    $request->session()->regenerate();

    $kycRoute = match ($request->user_type) {
        'supplier' => 'seller.kyc',
        'manufacturer' => 'manufacturer.kyc',
        default => 'user.kyc',
    };

    return redirect()->route($kycRoute)->with('success', 'Registration complete. Submit your KYC documents for admin approval.');
}




    private function getTableName($type)

    {

        if ($type === 'user') return 'users';

        if ($type === 'supplier') return 'suppliers';

        return 'manufacturers';

    }

}

