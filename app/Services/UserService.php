<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Http\Requests\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Role;
use App\Models\TimeSheet;
use App\Models\Task;
use App\Models\Report;

class UserService extends BaseService implements UserServiceInterface
{
    public function getAllUser(){
        return User::all();
    }

    public function getUserById($id){
        return User::find($id);
    }

    public function updateUser(Request $request){
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
    }

    public function deleteUser($memberId){
        $member = $this->getUserById($memberId);
        $timesheets = TimeSheet::where('user_id', $memberId)->get(); 
        if(count($timesheets) != 0) $this->destroyModels($timesheets);
        $reports = Report::where('user_id', $memberId)->get();
        if(count($reports) != 0) $this->destroyModels($reports);
        $member->is_active = 2;
        $member->save();
        $roles = $this->getRolesOfUser($member);
        foreach($roles as $role){
            $roleId = Role::where('name', $role)->get()->first()->id;
            $member->roles()->detach((int)$roleId);
        }
        $member->delete();
    }

    public function destroyModels($models){
        foreach($models as $model){
            $model->delete();
        }
    }

    public function createUser(RegisterRequest $request){
        $request->all();

        $avatar_name = '';
        if($request->hasFile('avatar')){
            $file = $request->avatar;
            $avatar_path = '/uploads/avatar/';
            $avatar_name = time().$request->username."-".$file->getClientOriginalName();
            $file->move(public_path().$avatar_path, $avatar_name);
        }
        $user =  User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'address'  => $request->address,
            'birthday' => convertFormatDate($request->birthday),
            'avatar'   => $avatar_name
        ]);
        return $user;
    }
    

    public function getRolesOfUser($user){
        return $user->roles()->pluck('name')->toArray();
    }

    public function getAndSortRolesOfUser($id){
        $user = $this->getUserById($id);
        $roles = $this->getRolesOfUser($user);
        sort($roles);
        return $roles;
    }

    public function updateRole(Request $request, $memberId){
        if($request->get('queries')){
            $queries = $request->get('queries');
            $user = $this->getUserById($memberId);
            $roles = $this->getRolesOfUser($user);
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
                    $roleId =  Role::where('name', $item)->get()->first()->id;
                    $user->roles()->detach((int)$roleId);
                }
            }
            
            return convertRolesArrayToString($this->getAndSortRolesOfUser($memberId));
        }
    }
}