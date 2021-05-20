<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TaskServiceInterface;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

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
        if($this->taskService->createTask($request, $timesheetId)){
            return redirect()->route('timesheets.index')->with('task-action-success', 'A new task was added');
        }else{
            return view('timesheet.task-create')->with('task-action-fail', 'Add new task failed');
        }
    }

    public function edit($timesheetId, $id){
        $task = $this->taskService->getById($id);
        if($this->authorize('update', $task)){
            return view('timesheet.task-edit', compact('task'));
        }
    }

    public function update(TaskRequest $request, $timesheetId, $id){
        if($this->taskService->updateTask($request, $id)){
            return redirect()->route('timesheets.index')->with('task-action-success', 'The task was updated');
        }else{
            return view('timesheet.task-create')->with('task-action-fail', 'Update task failed');
        }
    }

    public function destroy($timesheetId, $id){ 
        $task = $this->taskService->getById($id);
        if($this->authorize('delete', $task)){
            if($this->taskService->deleteTask($timesheetId, $task)){
                return redirect()->route('timesheets.index')->with('task-action-success', 'the task was deleted!');
            }else{
                return redirect()->route('timesheets.index')->with('task-action-fail', 'delete failed');
            }
        }
    }

}