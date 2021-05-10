<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUserProfilesRequest;
use App\User;
use App\Models\Report;
use App\Models\TimeSheet;

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
            $avatar_path = '/uploads/avatar/';
            $avatar_name = time().$request->username."-".$file->getClientOriginalName();
            $file->move(public_path().$avatar_path, $avatar_name);
            $user->avatar = $avatar_name;
        }

        $user->save();

        return redirect('user-profiles')->with('mes1', 'Your profiles have been updated!');
    }

    public function show($member_id){
        $member = Auth::user()->find((int)$member_id);
        return view('user.member', ['member'=>$member]);
    }

    public function destroy($member_id){
        $member = Auth::user()->find($member_id);
        if($member_id == 1){
            return view('user.member', ['member'=>$member])->with('user_action_fail', 'You must make other come admin role!');
        }else{
            $ts = TimeSheet::where('user_id', $member_id)->get(); 
            if(count($ts) != 0) $this->destroyArr($ts);
            $rp = Report::where('user_id', $member_id)->get();
            if(count($rp) != 0) $this->destroyArr($rp);
            $member->is_active = 2;
            $member->save();
            $member->delete();
            return redirect()->route('reports.index');
        }
    }

    public function destroyArr($arr){
        foreach($arr as $item){
            $item->delete();
        }
    }

    public function updateRole($member_id){
        
    }

}