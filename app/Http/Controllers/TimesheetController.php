<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimeSheet;
use App\Models\Report;
use App\Http\Requests\TimesheetRequest;
use Carbon\Carbon;

class TimesheetController extends Controller
{

    public function index(){
        $userId = Auth::user()->id;
        $timesheetList = User::find($userId)->timesheets;
        $tsTaskList = [];
        foreach($timesheetList as $ts){
            $tsTaskList[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        return view('timesheet.index', ['timesheets'=> $timesheetList, 'ts-tasks' => $tsTaskList]);
    }

    public function create(){
        if(Auth::user()->hasRole('admin')){
            return view('timesheet.timesheet-create');
        }else{
            $userId = Auth::user()->id;
            $timesheets = TimeSheet::where('user_id', $userId)->whereRaw('Date(created_at) = CURDATE()')->get()->pluck('created_at');
            if(count($timesheets) == 0){
                return view('timesheet.timesheet-create');
            }else{
                return redirect()->route('timesheets.index')->with('ts-action-fail', 'Can only create up to one timesheet per day!');
            }
        }
    }

    public function store(TimesheetRequest $request){
        $request->all();

        $userId = Auth::user()->id;
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $hour = $today->hour;
        $month = $today->month;
        $report = Report::find($userId);

        if($report === null || $report->month != $month){
            Report::create([
                'month' => $month,
                'user_id' => $userId,
                'registrations_times' => 1,
                'registrations_late_times' => $hour <= 9 ? 0 : 1, 
            ]);
        }else{
            $report->registrations_times = $report->registrations_times + 1;
            $report->registrations_late_times = $hour <=9 ? $report->registrations_late_times : $report->registrations_late_times + 1;
            $report->save();
        }

        $ts = TimeSheet::create([
            'user_id'  => $userId,
            'problems' => $request->problems,
            'plan'     => $request->plan,
        ]);

        if($ts){
            return redirect()->route('timesheets.index')->with('ts-action-success', 'A new timesheet was added!');
        }else{
            return view('timesheet.timesheet-create')->with('ts-action-fail', 'Add new timesheet failed!');
        }
    }

    public function edit($id){
        $timesheet = TimeSheet::find($id);
        return view('timesheet.timesheet-edit', compact('timesheet'));
    }

    public function update(TimesheetRequest $request, $id){
        $request->all();

        $ts = TimeSheet::find($id);
        $ts->problems = $request->problems;
        $ts->plan = $request->plan;

        if($ts->save()){
            return redirect()->route('timesheets.index')->with('ts-action-success', 'The timesheet was updated!');
        }else{
            return view('timesheet.timesheet-create')->with('ts-action-fail', 'Update timesheet fail!');
        }
    }

    public function destroy($id){
        $ts = TimeSheet::find($id);
        $canAction = $this->authorize('delete', $ts);
        if($canAction){
            $ts->delete();
            return redirect()->route('timesheets.index');
        }else{
            return redirect()->route('timesheets.index')->with('ts-action-fail', 'You can not delete!');
        }
       
    }

    public function getAll(){
        $userId = Auth::user()->id;
        $timesheetList = User::find($userId)->timesheets;
        $tsTaskList = [];
        foreach($timesheetList as $ts){
            $tsTaskList[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        $output = view('timesheet.admin-index', ['timesheets'=> $timesheetList, 'ts-tasks' => $tsTaskList])->render();
        return $output;
    }

}