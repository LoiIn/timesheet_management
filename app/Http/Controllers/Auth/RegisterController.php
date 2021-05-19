<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Config;
use App\Models\Report;
use Carbon\Carbon;
use App\Services\UserService;

class RegisterController extends Controller
{
    protected $userService; 

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    protected $redirectTo = '/home';

    public function register(){
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request){
        $user = $this->userService->createUser($request);
        
        if($user){
            $user->roles()->attach(3);
            $month = Carbon::now('Asia/Ho_Chi_Minh')->month;

            Report::create([
                'month' => $month,
                'user_id' => $user->id,
                'registrations_times' => 0,
                'registrations_late_times' => 0, 
            ]);

            return redirect('sign-in')->with('registerSuccess', 'Register successed, please login');
        }
        else{
            return redirect('sign-up', compact('user'))->with('registerFail', 'Register failed, please try again!');
        }
    }
}
