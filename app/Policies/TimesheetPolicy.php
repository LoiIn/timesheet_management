<?php

namespace App\Policies;

use App\Models\TimeSheet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimesheetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any time sheets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('manager');
    }

    /**
     * Determine whether the user can view the time sheet.
     *
     * @param  \App\User  $user
     * @param  \App\TimeSheet  $timeSheet
     * @return mixed
     */
    public function view(User $user, TimeSheet $timeSheet)
    {
        return $user->id === $timeSheet->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create time sheets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('member');
    }

    /**
     * Determine whether the user can update the time sheet.
     *
     * @param  \App\User  $user
     * @param  \App\TimeSheet  $timeSheet
     * @return mixed
     */
    public function update(User $user, TimeSheet $timeSheet)
    {
        if($user->id === $timeSheet->user_id) return true;
        else if($user->hasRole('manager')){
            return $timeSheet->user->hasRole('admin')? false : true;
        }
    }

    /**
     * Determine whether the user can delete the time sheet.
     *
     * @param  \App\User  $user
     * @param  \App\TimeSheet  $timeSheet
     * @return mixed
     */
    public function delete(User $user, TimeSheet $timeSheet)
    {   
        return $user->hasRole('admin');
    }
}
