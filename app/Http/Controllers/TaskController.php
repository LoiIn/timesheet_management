<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimeSheet;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Carbon;

class TaskController extends Controller
{

    public function postTask(TaskRequest $request, $timesheet_id){
        $request->all();
        $task = new Task;
        $task->content = $request->content;
        $today = Carbon::now()->day;
        $hours = $today->diffInHours($request->end_date);
        $task->time_exist = $hours;
        $task->save();

        $user_id = Auth::user()->id;
        $ts_list = User::find($user_id)->timesheets;
        $ts_task_list = [];
        foreach($ts_list as $ts){
            $ts_task_list[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        return view('timesheet.index', ['timesheets'=> $ts_list, 'ts_tasks' => $ts_task_list]);
    }

}