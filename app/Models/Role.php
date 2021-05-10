<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_permission', 'role_id');
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }
}