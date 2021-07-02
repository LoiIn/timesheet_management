<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\UpdatePasswordRequest;
use App\User;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\FileServiceInterface;

class UserController extends Controller
{
    protected $userService; 
    protected $fileService;

    public function __construct(UserServiceInterface $userService, FileServiceInterface $fileService){
        $this->userService = $userService;
        $this->fileService = $fileService;
    }

    public function index(){
        return view('user.index');
    }

    public function edit(){
        return view('user.edit');
    }

    public function update(UpdateUserRequest $request){
        $avatarName = $this->fileService->uploadAvatar($request, 're_avatar');

        if($this->userService->updateUser($avatarName, $request->except('_token'))){
            $request->session()->flash('user-action-success', 'Your profiles have been updated!');
        } else {
            $request->session()->flash('user-action-fail', 'Error!');
        }

        return redirect('user-profiles');
    }

    public function show($memberId){
        $member = $this->userService->getUserById($memberId);
        return view('user.member', ['member'=>$member]);
    }

    public function destroy($memberId, Request $request){
        if($this->authorize('delete', User::class)){
            if($memberId == 1){
                $request->session()->flash('user-action-fail', 'You must add admin roles for other people');
                return view('user.member', ['member'=>$member]);
            }else{
                $this->userService->deleteUser($memberId);
                $request->session()->flash('user-action-success', 'You deleted one user!');
                return redirect()->route('reports.index');
            }
        }
    }

    public function editRole($memberId){
        if($this->authorize('updateRole', User::class)){
            $roles = $this->userService->getAndSortRolesOfUser($memberId);
            $output = view('report.report-form', compact('roles'))->render();
            return $output;
        }
    }

    public function updateRole(Request $request, $memberId){
        $queries = $request->get('queries');
        return $this->userService->updateRole($queries, $memberId);
    }

    public function changePass(){
        return view('user.edit-pass');
    }

    public function saveNewPass(UpdatePasswordRequest $request){
        if(!$this->userService->saveNewPass($request->except('_token'))){
            $request->session()->flash('user-action-fail', 'Update password fail');
            return redirect()->back();
        }else{
            $request->session()->flash('resetSuccess', 'Update password success');
            return redirect()->route('logout');
        }
    }
}
