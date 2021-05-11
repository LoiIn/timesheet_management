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
        return view('timesheet.task-create');
    }

    public function store(TaskRequest $request, $timesheetId){
        $request->all();

        $task = Task::create([
            'content'  => $request->content,
            'end_date' => convertFormatDate($request->end_date)
        ]);
        
        if($task){
            $task->timesheets()->attach($timesheetId);
            return redirect()->route('timesheets.index')->with('task_action_success', 'A new task was added');
        }else{
            return view('timesheet.task-create')->with('task_action_fail', 'Add new task failed');
        }
    }

    public function edit($timesheetId, $id){
        $task = Task::find($id);
        return view('timesheet.task-edit', compact('task'));
    }

    public function update(TaskRequest $request, $timesheetId, $id){
        $request->all();
        
        $task = Task::find($id);
        $task->content = $request->content;
        $task->end_date = $request->end_date;

        if($task->save()){
            return redirect()->route('timesheets.index')->with('task_action_success', 'The task was updated');
        }else{
            return view('timesheet.task-create')->with('task_action_fail', 'Update task failed');
        }
    }

    public function destroy($timesheetId, $id){ 
        $task = Task::find($id);
        $task->timesheets()->detach((int)$timesheetId); 
        $task->delete();
        return redirect()->route('timesheets.index');
    }

}