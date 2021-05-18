<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request;
use App\User;
use App\Models\Report;
use App\Models\TimeSheet;
use App\Models\Role;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function edit(){
        return view('user.edit');
    }

    public function update(Request $request){
        
        $user = Auth::user();
        if($request->username != null) $user->username = $request->username;
    
        if($request->email != null) $user->email = $request->email;

        if($request->address != null)$user->address = $request->address;

        if($request->birthday != null) $user->birthday = $request->birthday;

        if($request->hasFile('re_avatar')){
            $file = $request->re_avatar;
            $avatarPath = '/uploads/avatar/';
            $avatarName = time().$request->username."-".$file->getClientOriginalName();
            $file->move(public_path().$avatarPath, $avatarName);
            $user->avatar = $avatarName;
        }

        $user->save();

        return redirect('user-profiles')->with('user-action-success', 'Your profiles have been updated!');
    }

    public function show($memberId){
        $member = Auth::user()->find((int)$memberId);
        return view('user.member', ['member'=>$member]);
    }

    public function destroy($memberId){
        $member = Auth::user()->find($memberId);
        if($this->authorize('delete', User::class)){
            if($memberId == 1){
                return view('user.member', ['member'=>$member])->with('user-action-fail', 'You must add admin roles for other people');
            }else{
                $ts = TimeSheet::where('user_id', $memberId)->get(); 
                if(count($ts) != 0) $this->destroyArr($ts);
                $rp = Report::where('user_id', $memberId)->get();
                if(count($rp) != 0) $this->destroyArr($rp);
                $member->is_active = 2;
                $member->save();
                $roles = $member->roles()->pluck('name')->toArray();
                foreach($roles as $role){
                    $roleId = Role::where('name', $role)->get()->first()->id;
                    $member->roles()->detach((int)$roleId);
                }
                $member->delete();
                return redirect()->route('reports.index');
            }
        }
    }

    public function destroyArr($arr){
        foreach($arr as $item){
            $item->delete();
        }
    }

    public function editRole($memberId){
        if($this->authorize('updateRole', User::class)){
            $roles = User::find($memberId)->roles()->pluck('name')->toArray();
            sort($roles);
            $output = view('report.report-form', compact('roles'))->render();
            return $output;
        }
    }

    public function updateRole(Request $request, $memberId){
        if($request->get('queries')){
            $queries = $request->get('queries');
            $user = User::find($memberId);
            $roles = $user->roles()->pluck('name')->toArray();
            $diffRole1 = array_diff($queries, $roles);
            $diffRole2 = array_diff($roles, $queries);
            
            if(count($diffRole1) != 0){
                foreach($diffRole1 as $item){
                    $roleId = Role::where('name', $item)->get()->first()->id;
                    $user->roles()->attach((int)$roleId);
                }
            }

            if(count($diffRole2) != 0){
                foreach($diffRole2 as $item){
                    $roleId = Role::where('name', $item)->get()->first()->id;
                    $user->roles()->detach((int)$roleId);
                }
            }
            
            return convertRolesArrayToString(User::find($memberId)->roles()->pluck('name')->toArray());
        }
    }
}
