<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\Request;

interface UserServiceInterface extends BaseInterface
{
    public function getAllUser();
    public function getUserById($id);
    public function createUser(RegisterRequest $request);
    public function deleteUser($id);
    public function updateUser(Request $request);
    public function getRolesOfUser($user);
    public function getAndSortRolesOfUser($id);
    public function saveNewPass(UpdatePasswordRequest $request);
}