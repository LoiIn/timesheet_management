<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\TimeSheet;

class CalendarController extends Controller
{
    public function index(){
        $timesheets = TimeSheet::all();
        return view('calendar.index', compact('timesheets'));
    }
}
