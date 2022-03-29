<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

use App\Notifications\VerifyRegistration;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
     protected function guard()
  {
    return Auth::guard('web');
  }

   public function login(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
    ]);

    //Find User by this email
    $user = User::where('email', $request->email)->first();

    if ($user->status == 1) {
      // login This User

      if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // Log Him Now
        return redirect()->intended(route('index'));
      }else {
        session()->flash('error', 'Invalid loging');
        return back();
      }
    }else {
      // send him a token again
      if (!is_null($user)) {
        $user->notify(new VerifyRegistration($user));
        session()->flash('success', 'A new confirmation email has sent you, please check and login');
        
        return redirect('/');
      }else {
        session()->flash('error', 'Please register first . Then loging..!!');
        return redirect()->route('login');
      }
    }

  }

   public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

}
