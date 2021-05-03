<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUserProfilesRequest;
use App\User;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function edit(){
        return view('user.edit');
    }

    public function update(EditUserProfilesRequest $request){
        
        $user = Auth::user();
        if($request->username != null) $user->username = $request->username;
    
        if($request->email != null) $user->email = $request->email;

        if($request->address != null)$user->address = $request->address;

        if($request->birthday != null) $user->birthday = $request->birthday;

        if($request->hasFile('re_avatar')){
            $file = $request->re_avatar;
            $avatar_path = '/source/images/avatar/';
            $avatar_name = time().$request->username."-".$file->getClientOriginalName();
            $file->move(public_path().$avatar_path, $avatar_name);
            $user->avatar = $avatar_name;
        }

        $user->save();

        return redirect('user-profiles')->with('mes1', 'Your profiles have been updated!');
    }

}