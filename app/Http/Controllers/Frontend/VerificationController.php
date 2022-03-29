<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('remember_token',$token)->first();

        if (!is_null($user)) {
         $user->status = 1;
         $user->remember_token = NULL;
         $user->save();

         session()->flash('success', 'Your registration has been successfully, please login in!');
           // session()->flash('success', 'Your registration has been successfully, please login in!');
         return redirect()->route('login');
     }else{
        session()->flash('errors', 'Sorry your token dose not match ! please registration first.');
        return redirect()->route('/');

    }

}
}
