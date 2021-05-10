<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use Config;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function register(){
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request){
        $request->all();
        
        $user = $this->create($request);
        
        if($user){
            return redirect('sign-in')->with('registerSuccess', 'Register successed, please login');
        }
        else{
            return redirect('sign-up', compact('user'))->with('registerFail', 'Register failed, please try again!');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create($data)
    {
        $avatar_name = '';
        if($data->hasFile('avatar')){
            $file = $data->avatar;
            $avatar_path = '/uploads/avatar/';
            $avatar_name = time().$data->username."-".$file->getClientOriginalName();
            $file->move(public_path().$avatar_path, $avatar_name);
            $user->avatar = $avatar_name;
        }
        $user =  User::create([
            'username' => $data->username,
            'email'    => $data->email,
            'password' => bcrypt($data->password),
            'address'  => $data->address,
            'birthday' => convertFormatDate($data->birthday),
            'avatar'   => $avatar_name
        ]);
        return $user;
    }
}
