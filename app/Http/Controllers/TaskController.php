<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TaskServiceInterface;
use App\Models\Task;
use App\Http\Requests\Tasks\TaskRequest;
use App\Http\Requests\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskServiceInterface $taskService){
        $this->taskService = $taskService;
    }

    public function index($timesheetId){
        $tasks = $this->taskService->getAllByTimesheetId($timesheetId);
        $output = view('timesheet.task', compact('tasks'))->render();
        return $output;
    }

    public function create(){
        if($this->authorize('create', Task::class)){
            return view('timesheet.task-create');
        }
    }

    public function store(TaskRequest $request, $timesheetId){
        if($this->taskService->createTask($request->except('_token'), $timesheetId)){
            $request->session()->flash('task-action-success', 'A new task was added');
            return redirect()->route('timesheets.index');
        }else{
            $request->session()->flash('task-action-fail', 'Add new task failed');
            return view('timesheet.task-create');
        }
    }

    public function edit($timesheetId, $id){
        $task = $this->taskService->getById($id);
        if($this->authorize('update', $task)){
            return view('timesheet.task-edit', compact('task'));
        }
    }

    public function update(TaskRequest $request, $timesheetId, $id){
        if($this->taskService->updateTask($request->except('_token'), $id)){
            $request->session()->flash('task-action-success', 'The task was updated');
            return redirect()->route('timesheets.index');
        }else{
            $request->session()->flash('task-action-fail', 'Updat task failed');
            return view('timesheet.task-create');
        }
    }

    public function destroy($timesheetId, $id, Request $request){ 
        $task = $this->taskService->getById($id);
        if($this->authorize('delete', $task)){
            if($this->taskService->deleteTask($timesheetId, $task)){
                $request->session()->flash('task-action-success', 'the task was deleted!');
                return redirect()->route('timesheets.index');
            }else{
                $request->session()->flash('task-action-fail', 'delete failed');
                return redirect()->route('timesheets.index');
            }
        }
    }

}