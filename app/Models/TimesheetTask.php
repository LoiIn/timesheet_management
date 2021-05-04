<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimesheetTask extends Model
{
    use SoftDeletes;
    protected $table = "ts_task";

    protected $fillable = [
        'ts_id',
        'task_id'
    ];

}