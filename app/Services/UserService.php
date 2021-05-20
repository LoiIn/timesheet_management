<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\FileServiceInterface;
use App\Services\Interfaces\ReportServiceInterface;
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

    protected $fileService;
    protected $reportService;

    public function __construct(FileServiceInterface $fileService, ReportServiceInterface $reportService){
        $this->fileService = $fileService;
        $this->reportService = $reportService;
    }

    public function getAllUser(){
        return User::all();
    }

    public function getUserById($id){
        return User::find($id);
    }

    public function updateUser(Request $request){
        $request->all();

        $user = Auth::user();
        $user->update([
            'username' => $request->username,
            'email'    => $request->email,
            'address'  => $request->address,
            'birthday' => $request->birthday,
            'avatar'   => $this->fileService->uploadAvatar($request, 're_avatar')
        ]);
    }

    public function deleteUser($memberId){
        $member = $this->getUserById($memberId);
        $member->timesheets()->delete();
        $member->reports()->delete();
        $member->update(['is_active' => 2]);
        $member->delete();
    }

    public function createUser(RegisterRequest $request){
        $request->all();

        $avatar_name = $this->fileService->uploadAvatar($request, 'avatar');
        $user =  User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'address'  => $request->address,
            'birthday' => convertFormatDate($request->birthday),
            'avatar'   => $avatar_name
        ]);
        if($user) $this->reportService->create($user);

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