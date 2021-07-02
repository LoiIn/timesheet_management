<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\User;

interface UserServiceInterface extends BaseInterface
{
    public function getAllUser();
    public function getUserById($id);
    public function createUser(string $avatarName, array $data);
    public function deleteUser($id);
    public function updateUser(string $avatarName, array $data);
    public function getRolesOfUser(User $user);
    public function updateRole($queries, $memberId);
    public function getAndSortRolesOfUser($id);
    public function saveNewPass(array $data);
}