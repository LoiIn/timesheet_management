<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimesheetTask;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Carbon\Carbon;
use Config;

class TaskController extends Controller
{

    public function create(){
        return view('timesheet.task_create');
    }

    public function store(TaskRequest $request, $ts_id){
        $request->all();

        if($this->insertOrUpdate($request, $ts_id)){
            return redirect()->route('timesheets.index')->with('task_action_success', 'A new task was added');
        }else{
            return view('timesheet.task_create')->with('task_action_fail', 'Add new task failed');
        }
    }

    public function edit($ts_id, $id){
        $task = Task::find($id);
        return view('timesheet.task_edit', compact('task'));
    }

    public function update(TaskRequest $request, $ts_id, $id){
        $request->all();

        if($this->insertOrUpdate($request, $ts_id, $id)){
            return redirect()->route('timesheets.index')->with('task_action_success', 'The task was updated');
        }else{
            return view('timesheet.task_create')->with('task_action_fail', 'Update task failed');
        }
    }

    public function destroy($ts_id, $id){ 
        $task = Task::find($id);
        $ts_task = TimesheetTask::where('task_id', $id)->delete();
        $task->delete();
        return redirect()->route('timesheets.index');
    }

    public function insertOrUpdate(TaskRequest $request, $ts_id, $task_id = ''){
        $task = new Task;
        if($task_id) $task = Task::find($task_id);
        $task->content = $request->content;
        $_date = convertFormatDate($request->end_date);
        $task->end_date = $_date;
        $start_date = Carbon::now();
        $end_date = Carbon::createFromFormat('Y-m-d', $_date);
        $hours = $end_date->diffInHours($start_date, true);
        $task->time_exist = $hours*1.0;
        if(!$task->save()){
           return false; 
        }

        if(!$task_id){
            $ts_task = new TimesheetTask;
            $ts_task->task_id = $task->id;
            $ts_task->ts_id = (int)$ts_id;
            if(!$ts_task->save()) return false;
        }
        return true;
    }
}