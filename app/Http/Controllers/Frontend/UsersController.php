<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

use App\Models\Division;
use App\Models\District;
use App\Models\User;
use Auth;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.pages.users.dashboard', compact('user'));
    }  

    public function profileEdit()
    {
        $user = Auth::user();
        $divisions = Division::orderBy('priority_id', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        return view('frontend.pages.users.edit', compact('user', 'districts', 'divisions'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
       'first_name' => 'required', 'string', 'max:50',
       'last_name' => 'required', 'string', 'max:30',
       'username' => 'string', 'alpha_dash', 'max:100', 'unique:users, username,'.$user->id,
       'email' => 'required', 'string', 'email', 'max:100', 'unique:users, email,'.$user->id,
       'division_id' => 'required', 'numeric',
       'district_id' => 'required', 'numeric',
       'phone_no' => 'required', 'max:15', 'unique:users, phone_no,'.$user->id,
       'street_address' => 'required', 'max:100',
   ]);
 
        // $this->validate($request, [

        //     'first_name' => ['required', 'string', 'max:100'],
        //     'last_name' => ['required', 'string', 'max:100'],

        //      'username' => ['required', 'string,','alpha_dash','unique:users,username,'.$user->id],
        //     'phone_no' => ['required', 'numeric', 'max:12','unique:users,phone_no,'.$user->id],
        //     'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,'.$user->id],
        //     'password' => ['required','min:6','confirmed'],
        //     'street_address' => ['required', 'max:200'],
        //     'division_id' => ['required', 'numeric'],
        //     'district_id' => ['required', 'numeric'],
        // ]);



        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = Str::slug($request->first_name . $request->last_name);
        $user->phone_no = $request->phone_no;
        $user->email = $request->email;
        if ( $request->password != NULL || $request->password != "") {
           $user->password = Hash::make($request->password);
        }
        $user->password = Hash::make($request->password);
        $user->ip_address = request()->ip();
        $user->avatar = $request->avatar;
        $user->status = $request->status;
        $user->street_address = $request->street_address;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->shipping_address = $request->shipping_address;
        $user->remember_token = Str::random(40);
        $user->status = 0;

        $user->save();

        session()->flash('success', 'User profile updated successfully!');
        return redirect()->route('user.dashboard');
    }
}
