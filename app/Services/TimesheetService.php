<?php

namespace App\Services;

use App\Services\Interfaces\TimesheetServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
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

    public function getAll(){
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

    public function createTimesheet(array $data){
        $userId = Auth::user()->id;
        $today = Carbon::now();
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

        $params = [
            'user_id'  => $userId,
            'problems' => \Arr::get($data, 'problems'),
            'plan'     => \Arr::get($data, 'plan'),
        ];

        return TimeSheet::create($params);
    }

    public function updateTimesheet(array $data, $id){
        $timesheet = TimeSheet::find($id);
        $params = [
            'problems' => \Arr::get($data, 'problems'),
            'plan'     => \Arr::get($data, 'plan'),
        ];

        return $timesheet->update($params);
    }

    
    public function deleteTimesheet($timesheet = null){
        return $timesheet->delete();
    }

    public function getTasksOfTimesheets($timesheets = null){
        $timesheetTasks = [];
        foreach($timesheets as $ts){
            $timesheetTasks[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        return $timesheetTasks;
    }
}