<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSheet;

class PageController extends Controller
{
    public function home(){
        return view('home.index');
    }

    public function calendarIndex(){
        $timesheets = TimeSheet::all();
        return view('calendar.index', compact('timesheets'));
    }
}