<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Image;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function show_register(){
        return view('auth.register');
    }

    public function do_register(Request $request){
        $this->validate($request, [
            'username'      => 'string|required|unique:users,username|min:5|max:32',
            'password'      => 'string|required|min:3|max:16',
            'email'         => 'string|required|unique:users,email|email:rfc,dns',
            're_password'   => 'string|required|same:password'
        ], [
            'username.unique'=>'The Username already exists',
            'username.max'   =>'Username must be less than 32 characters',
            'username.min'   =>'Username must be more than 5 characters',
            'password.max'   =>'Username must be less than 16 characters',
            'password.min'   =>'Username must be more than 3 characters',
            'email.unique'   =>'The Email already exists',
            're_password'    =>'The re_password is incorrect'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->address  = $request->address;
        $user->birthday = '2021-04-27';
        if($request->hasFile('avatar')){
            $file = $request->avatar;
            $avatar_path = '/source/images/avatar/';
            $avatar_name = time().$request->username."-".$file->getClientOriginalName();
            $file->move(public_path().$avatar_path, $avatar_name);
            $user->avatar = $avatar_name;
        }
        $user->role     = 2;
        $user->save();
        return redirect('sign_in')->with('registerSuccess', 'Register successed, please login');
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
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
