<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\RegisterRequest;    
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\FileServiceInterface;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService, FileServiceInterface $fileService){
        $this->userService = $userService;
        $this->fileService = $fileService;
    }

    protected $redirectTo = '/home';

    public function register(){
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request){
        $avatarName = $this->fileService->uploadAvatar($request, 'avatar');
        $user = $this->userService->createUser($avatarName, $request->except('_token'));
        if($user){
            $request->session()->flash('registerSuccess', 'Register successed, please login');
            return redirect('sign-in');
        }else{
            $request->session()->flash('registerFail', 'Register failed, please try again!');
            return redirect('sign-up', compact('user'));
        }
    }
}
