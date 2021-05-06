<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    
    protected $fillable = ['name', 'title'];

    public function roles(){
        return $this->belongsToMany('App\Models\Role'. 'permission_role', 'permission_id');
    }

}