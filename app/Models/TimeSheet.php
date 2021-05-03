<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $table = "timesheets";

    protected $fillable = [
        'problems',
        'plan'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tasks(){
        return $this->belongsToMany('App\Models\Task', 'ts_task', 'ts_id');
    }
   
}
