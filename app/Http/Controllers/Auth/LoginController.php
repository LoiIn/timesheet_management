<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\LoginRequest;
use App\Services\Interfaces\UserServiceInterface;

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
    protected $userService;

    public function login(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request){

        $request->all();

        $email = $request->email;
        $password = $request->password;

        $user = (['email'=>$email, 'password'=>$password]);

        if(Auth::attempt($user)){
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

    //google login
    public function redirectToGoogle(){
        return $this->userService->redirectToProvider('google');
    }

    //google callback
    public function handleGoogleCallback(){
        $this->userService->handleProviderCallback('google');
        return redirect('home')->with('loginSuccess', 'Welcome our service!');
    }

    //facebook login
    public function redirectToFacebook(){
        return $this->userService->redirectToProvider('facebook');
    }

    //facebook callback
    public function handleFacebookCallback(){
        $this->userService->handleProviderCallback('facebook');
        return redirect('home')->with('loginSuccess', 'Welcome our service!');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }
}
