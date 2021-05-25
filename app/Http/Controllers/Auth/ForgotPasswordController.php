<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Str;
use App\Http\Requests\Request;
use App\Http\Requests\ResetPasswordRequest;
use Mail;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('auth.password.forgot');
    }

    public function sendMail(Request $request){
        $email = $request->email;
        
        $user = User::where('email', $email)->first();
        if(!$user){
            return redirect()->back()->with('getFail', 'Email is not exist!');
        }
        

        $code = bcrypt(md5(time().$email));

        $user->update([
            'code' => $code,
            'time_code' => Carbon::now()
        ]);

        $url = route('password.reset', ['code' => $user->code, 'email' => $email]);

        $data = ['route' => $url];

        Mail::send('auth.mail.feedback', $data, function($message) use ($email){
            $message->to($email, 'Reset Password')->subject('Get Password');
        });

        return redirect()->back()->with('getSuccess', 'The link to reset password has beed gave in your email address!');
    }

    public function resetPass(Request $request){
        $user = User::where([
            'code' => $request->code,
            'email' => $request->email
        ])->first();

        if(!$user){
            return redirect('/')->with('resetFail', 'Sorry! Link is not correct! Try again!');
        }

        return view('auth.password.reset');
    }

    public function savePass(ResetPasswordRequest $request){
        $request->all();

        $user = User::where([
            'code' => $request->code,
            'email' => $request->email
        ])->first();

        if(!$user){
            return redirect('/')->with('resetFail', 'Sorry! Link is not correct! Try again!');   
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login.index')->with('resetSuccess', 'Reset passord success! Login now!');
    }
}

