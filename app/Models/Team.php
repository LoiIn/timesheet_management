<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    protected $table = "teams";

    protected $fillable = ['leader_id', 'name'];
    
    public function users(){
        return $this->belongsToMany('App\User', 'team_user', 'team_id', 'user_id');
    }
}
