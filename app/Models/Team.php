<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "teams";

    protected $fillable = ['leader_id', 'name'];
    
    public function users(){
        return $this->belongsToMany('App\User', 'team_user', 'team_id', 'user_id');
    }
}
