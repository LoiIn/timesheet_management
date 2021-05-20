<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\UserServiceInterface;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService){
        $this->userService = $userService;
    }

    protected $redirectTo = '/home';

    public function register(){
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request){
        $user = $this->userService->createUser($request);
        
        if($user) return redirect('sign-in')->with('registerSuccess', 'Register successed, please login');
        else return redirect('sign-up', compact('user'))->with('registerFail', 'Register failed, please try again!');
    }
}
