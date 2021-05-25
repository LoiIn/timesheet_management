<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService; 

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index(){
        return view('user.index');
    }

    public function edit(){
        return view('user.edit');
    }

    public function update(Request $request){
        $this->userService->updateUser($request);
        return redirect('user-profiles')->with('user-action-success', 'Your profiles have been updated!');
    }

    public function show($memberId){
        $member = $this->userService->getUserById($memberId);
        return view('user.member', ['member'=>$member]);
    }

    public function destroy($memberId){
        if($this->authorize('delete', User::class)){
            if($memberId == 1){
                return view('user.member', ['member'=>$member])->with('user-action-fail', 'You must add admin roles for other people');
            }else{
                $this->userService->deleteUser($memberId);
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
        return $this->userService->updateRole($request, $memberId);
    }

    public function changePass(){
        return view('user.edit-pass');
    }

    public function saveNewPass(UpdatePasswordRequest $request){
        if(!$this->userService->saveNewPass($request)){
            return redirect()->back()->with('resetFail', 'Update password fail');
        }
        return redirect()->route('logout')->with('resetSuccess', 'Update password success');
    }
}
