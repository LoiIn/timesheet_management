<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimeSheet;
use App\Http\Requests\TimesheetRequest;

class TimesheetController extends Controller
{

    public function index(){
        $user_id = Auth::user()->id;
        $ts_list = User::find($user_id)->timesheets;
        $ts_task_list = [];
        foreach($ts_list as $ts){
            $ts_task_list[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        return view('timesheet.index', ['timesheets'=> $ts_list, 'ts_tasks' => $ts_task_list]);
    }

    public function create(){
        return view('timesheet.timesheet_create');
    }

    public function store(TimesheetRequest $request){
        $request->all();
        
        if($this->insertOrUpdate($request)){
            return redirect()->route('timesheets.index')->with('ts_action_success', 'A new timesheet was added!');
        }else{
            return view('timesheet.timesheet_create')->with('ts_action_fail', 'Add new timesheet failed!');
        }
    }

    public function edit($id){
        $timesheet = TimeSheet::find($id);
        return view('timesheet.timesheet_edit', compact('timesheet'));
    }

    public function update(TimesheetRequest $request, $id){
        $request->all();

        if($this->insertOrUpdate($request, $id)){
            return redirect()->route('timesheets.index')->with('ts_action_success', 'The timesheet was updated!');
        }else{
            return view('timesheet.timesheet_create')->with('ts_action_fail', 'Update timesheet fail!');
        }
    }

    public function insertOrUpdate(TimesheetRequest $request, $id = ''){
        $ts = new TimeSheet;
        if($id) $ts = TimeSheet::find($id);
        $ts->user_id = Auth::user()->id;
        $ts->problems = $request->problems;
        $ts->plan = $request->plan;
        if(!$ts->save()) return false;
        return true;
    }

}