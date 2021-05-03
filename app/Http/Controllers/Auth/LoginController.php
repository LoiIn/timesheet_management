<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function login(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request){

       $request->all();

        $email = $request->email;
        $password = $request->password;

        $data_user = (['email'=>$email, 'password'=>$password]);

        if(Auth::attempt($data_user)){
            return redirect('home')->with('loginSuccess', 'Welcome our service!');
        }else{
            return redirect('sign-in')->with('loginFail', 'Login in fail!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('sign-in');
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
