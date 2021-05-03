<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

    protected $fillable = [
        'content',
        'time_exist'
    ];

    public function timesheets(){
        return $this->belongsToMany('App\Models\Timesheet');
    }
}
