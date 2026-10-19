<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Supplier;

use App\Models\Manufacturer;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;



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
    $request->validate([
        'user_type' => 'required|in:user,supplier,manufacturer',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'password' => 'required|confirmed|min:6',
        // 'country_code' => 'required',
    ]);

    $emailExists = User::where('email', $request->email)->exists() ||
                   Supplier::where('email', $request->email)->exists() ||
                   Manufacturer::where('email', $request->email)->exists();

    $phoneExists = User::where('phone', $request->phone)->exists() ||
                    Supplier::where('phone', $request->phone)->exists() ||
                    Manufacturer::where('phone', $request->phone)->exists();

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
        'phone' => $request->phone,
        'country_code' => $request->country_code,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ];

    // Add company name if needed
    if (in_array($request->user_type, ['supplier', 'manufacturer'])) {
        $data['company_name'] = $request->company_name;
    }

    // Create user
    $user = $model::create($data);

    // Redirect to login
    return redirect()->route('login')->with('success', 'Registration successful! Please login.');
}




    private function getTableName($type)

    {

        if ($type === 'user') return 'users';

        if ($type === 'supplier') return 'suppliers';

        return 'manufacturers';

    }

}

