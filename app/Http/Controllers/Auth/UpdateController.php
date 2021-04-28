<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditUserProfilesRequest;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function postUserProfiles(EditUserProfilesRequest $request){
        
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

        return redirect('profiles')->with('mes1', 'Your profiles have been updated!');
    }
}
