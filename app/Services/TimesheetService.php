<?php

namespace App\Services;

use App\Services\Interfaces\TimesheetServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Http\Requests\Request;
use App\Http\Requests\TimesheetRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSheet;
use App\Models\Team;
use App\Models\Report;
use Carbon\Carbon;

class TimesheetService extends BaseService implements TimesheetServiceInterface
{
    protected $userService;

    public function __construct(UserServiceInterface $userService){
        $this->userService = $userService;
    }

    public function getAllTimesheet(){
        return TimeSheet::all();
    }

    public function getTimesheetsByUser(){
        $userId = Auth::user()->id;
        return $this->userService->getUserById($userId)->timesheets;
    }

    public function getTimesheetById($id){
        return TimeSheet::find($id);
    }

    public function getTimesheetsByTeam($leaderId){
        $team = Team::where('leader_id', $leaderId)->get()->first();
        $members = $team->users;
        $timesheets = [];
        foreach($members as $member){
            foreach($member->timesheets as $timesheet){
                $timesheets[] = $timesheet;
            }
        }
        return $timesheets;
    }

    public function checkCreatedTimesheet(){
        $userId = Auth::user()->id;
        $timesheets = TimeSheet::where('user_id', $userId)->whereRaw('Date(created_at) = CURDATE()')->get()->pluck('created_at');
        return count($timesheets);
    }

    public function createTimesheet(TimesheetRequest $request){
        $request->all();

        $userId = Auth::user()->id;
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $hour = $today->hour;
        $month = $today->month;
        $report = Report::find($userId);

        if((int)$report->month != $month){
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

        $timesheet = TimeSheet::create([
            'user_id'  => $userId,
            'problems' => $request->problems,
            'plan'     => $request->plan,
        ]);

        return $timesheet;
    }

    public function updateTimesheet(Request $request, $id){
        $request->all();

        $timesheet = TimeSheet::find($id);
        $timesheet->problems = $request->problems;
        $timesheet->plan = $request->plan;
        
        return $timesheet->save();
    }

    
    public function deleteTimesheet($timesheet = null){
        if ($timesheet == null) return false;

        $taskIds = $timesheet->tasks()->pluck('task_id')->toArray();
        foreach($taskIds as $id){
            $timesheet->tasks()->detach($id);
        }

        if($timesheet->delete()) return true;
    }

    public function getTasksOfTimesheets($timesheets = null){
        $timesheetTasks = [];
        foreach($timesheets as $ts){
            $timesheetTasks[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        return $timesheetTasks;
    }
}