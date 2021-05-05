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
        //
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
        return $user->id === $timeSheet->user_id;
    }

    /**
     * Determine whether the user can create time sheets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        //
    }

    /**
     * Determine whether the user can restore the time sheet.
     *
     * @param  \App\User  $user
     * @param  \App\TimeSheet  $timeSheet
     * @return mixed
     */
    public function restore(User $user, TimeSheet $timeSheet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the time sheet.
     *
     * @param  \App\User  $user
     * @param  \App\TimeSheet  $timeSheet
     * @return mixed
     */
    public function forceDelete(User $user, TimeSheet $timeSheet)
    {
        //
    }
}
