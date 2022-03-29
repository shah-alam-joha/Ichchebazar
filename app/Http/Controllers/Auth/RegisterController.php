<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



use App\Models\Division;
use App\Models\District;

use App\Notifications\VerifyRegistration;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    *

 */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

     // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*
    * override RegisterUsers method 
    */

    public function showRegistrationForm()
    {
        $divisions = Division::orderBy('priority_id', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        return view('auth.register', compact('divisions', 'districts'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    protected function validator(Request $request)
   
    {
        return Validator::make($request, [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string'],
            'phone_no' => ['required','numeric', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string','min:6','confirmed'],
            'street_address' => ['required', 'string', 'max:200'],
            'shipping_address' => ['required', 'string', 'max:200'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
        $this->validate( $request, [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            // 'username' => ['required', 'string'],
            'phone_no' => ['required', 'numeric', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string','min:6','confirmed'],
            'street_address' => ['required', 'string', 'max:200'],
            'shipping_address' => ['required', 'string', 'max:200'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => Str::slug($request->first_name . $request->last_name),
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ip_address' => request()->ip(),
            'avatar' => $request->avatar,
            'status' => $request->status,
            'street_address' => $request->street_address,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'shipping_address' => $request->shipping_address,
            'remember_token' => Str::random(40),
            'status' => 0,

        ]);

        $user->notify(new VerifyRegistration($user));

      session()->flash('success', 'A new confirmation mail has been sent you. Please check it.');
        return redirect()->route('index');
    }
}
