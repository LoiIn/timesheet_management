<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{   
    use SoftDeletes;
    protected $table = "tasks";

    protected $fillable = [
        'content','end_date'
    ];

    public function timesheets(){
        return $this->belongsToMany('App\Models\TimeSheet', 'ts_task', 'task_id', 'ts_id');
    }
}
