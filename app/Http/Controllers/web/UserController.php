<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function forgot_password(){
        return view('web.auth.forgotpassword');
    }

    public function forgot_password_email(Request $request){
        $validator = $request->validate(User::$rules);
        $user = User::where('email' , $request->email)->where('user_name' , $request->user_name)->first();
        if ($user){
            return redirect()->route('GETresetPassword' , ['email' => $user->email]);
        }else{
            toastr()->error(__('lang.error'));
            return redirect()->back();
        }
    }

    public function reset_password($email){
        $user = User::where('email' , $email)->first();
        if ($user){
            return view('web.auth.resetpassword' , compact('user'));
        }else{
            abort(404);
        }
    }

    public function reset_password_user(Request $request , $user_name){
        $validator = $request->validate(User::$rules2);
        $user = User::where('email' , $user_name)->first();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        toastr()->success(__('lang.success'));
        return redirect()->route('login');
    }
}
