<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'address', 'birthday', 'avatar'
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

    public function teams(){
        return $this->belongsToMany('App\Models\Team', 'team_user', 'user_id', 'team_id');
    }

    public function timesheets(){
        return $this->hasMany('App\Models\TimeSheet');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role){
        if (is_string($role)) {
            return $this->roles()->where('name', $role)->first();
        }
        return false;
    }

    public function getCurTeams($user_id){
        $teams = $this->teams;
        $teamArr = '';
        foreach($teams as $team){
            $teamArr = $teamArr.$team->name.', ';
        }
        return $teamArr;
    }
}
