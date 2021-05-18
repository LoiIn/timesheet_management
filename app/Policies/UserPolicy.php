<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

   public function updateRole(User $user){
       return $user->hasRole('admin');
   }

   public function delete(User $user){
        return $user->hasRole('admin');
   }
}
