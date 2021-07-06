<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\ReportServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Role;
use App\Models\TimeSheet;
use App\Models\Task;
use App\Models\Report;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserService extends BaseService implements UserServiceInterface
{
    protected $reportService;

    public function __construct(ReportServiceInterface $reportService){
        $this->reportService = $reportService;
    }

    public function getAllUser(){
        return User::all();
    }

    public function getUserById($id){
        return User::find($id);
    }

    public function updateUser(string $avatarName, array $data){
        $user = Auth::user();
        
        $params = [
            'username' => \Arr::get($data, 'username'),
            'email'    => \Arr::get($data, 'email'),
            'address'  => \Arr::get($data, 'address'),
            'birthday' => \Arr::get($data, 'birthday'),
            'avatar'   => $avatarName,
        ];

       return $user->update($params);
    }

    public function deleteUser($memberId){
        $member = $this->getUserById($memberId);
        $member->timesheets()->delete();
        $member->reports()->delete();
        $member->update(['is_active' => 2]);
        $member->delete();
    }

    public function createUser(string $avatarName, array $data){
        $params = [   
            'username' => \Arr::get($data, 'username'),
            'email'    => \Arr::get($data, 'email'),
            'password' => bcrypt(\Arr::get($data, 'password')),
            'address'  => \Arr::get($data, 'address'),
            'birthday' => convertFormatDate(\Arr::get($data, 'birthday')),
            'avatar'   => $avatarName
        ];

        $user = User::create($params);
        if($user) $this->reportService->create($user);
        return true;
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

    public function updateRole($queries, $memberId){
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

    public function saveNewPass(array $data){
        $user = Auth::user();
        $hashedPass = $user->password;
        $curPass = \Arr::get($data, 'cur-password');
        
        if(!Hash::check($curPass, $hashedPass)) return false;

        $user->update([
            'password' => bcrypt(\Arr::get($data, 'new-password')),
        ]);
        return true;
    }

    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider){
        $user = Socialite::driver($provider)->user();
        $authUser = $this->mainProviderLogin($user);
        return Auth::login($authUser);
    }

    public function mainProviderLogin($data){
        $user = User::where('username', '=', $data->name)->first();
        if($user) return $user;
        else{
            $params = [
                'username' => $data->name,
                'email'    => $data->email !== null ? $data->email : 'example@gmail.com',
                'password' => bcrypt($data->id),
            ];

            $newUser = User::create($params);
            $this->reportService->create($newUser);
            return $newUser;
        }
    }
}