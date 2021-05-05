<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "reports";

    protected $fillable = ['month','user_id', 'registrations_times', 'registrations_late_times'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
