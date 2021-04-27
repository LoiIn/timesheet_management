<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

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
    protected $redirectTo = '/home';

    public function show_login(){
        return view('auth.login');
    }

    public function do_login(Request $request){

        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:3|max:16'
        ], [
            'email.email' => 'Input correct format of email',
            'password.min' => 'Min length of password is 3',
            'password.max' => 'Max length of password is 16'
        ]);

        $email = $request->email;
        $password = $request->password;

        $data_user = (['email'=>$email, 'password'=>$password]);

        if(Auth::attempt($data_user)){
            $username = Auth::user()->username;
            return redirect('home');
        }else{
            return redirect('sign_in')->with('loginFail', 'Sign in fail!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('sign_in');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
