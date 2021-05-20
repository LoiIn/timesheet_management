<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TimesheetServiceInterface;

class PageController extends Controller
{
    protected $timesheetService;

    public function __construct(TimesheetServiceInterface $timesheetService){
        $this->timesheetService = $timesheetService;
    }

    public function home(){
        return view('home.index');
    }

    public function calendarIndex(){
        $timesheets = $this->timesheetService->getAll();
        return view('calendar.index', compact('timesheets'));
    }
}