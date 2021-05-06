<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use App\Traits\HasPermissions;
use App\Models\Permission;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $permissionList = null;

    public function timesheets(){
        return $this->hasMany('App\Models\TimeSheet');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasPermission($permission = null)
    {
        if (is_null($permission)) {
            return $this->getPermissions()->count();
        }

        if (is_string($permission)) {
            return $this->getPermissions()->contains('name', $permission);
        }

        return false;
    }

    private function getPermissions()
    {
        $role = $this->roles->first();
        if ($role) {
            if (! $role->relationLoaded('permissions')) {
                $this->roles->load('permissions');
            }

            $this->permissionList = $this->roles->pluck('permissions')->flatten();
        }

        return $this->permissionList ?? collect();
    }
}
