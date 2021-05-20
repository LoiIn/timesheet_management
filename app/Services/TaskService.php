<?php

namespace App\Services;

use App\Services\Interfaces\TaskServiceInterface;
use App\Http\Requests\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSheet;
use App\Models\Task;

class TaskService extends BaseService implements TaskServiceInterface
{
    public function getById($id){
        return Task::find($id);
    }

    public function getAllByTimesheetId($timesheetId){
        return TimeSheet::find($timesheetId)->tasks;
    }

    public function createTask(TaskRequest $request, $timesheetId){
        $request->all();

        $task = Task::create([
            'content'  => $request->content,
            'end_date' => convertFormatDate($request->end_date)
        ]);
        if($task){
            $task->timesheets()->attach($timesheetId);
            return true;
        }

        return false;
    }

    public function updateTask(Request $request, $id){
        $request->all();
        
        $task = Task::find($id);
        $task->update([
            'content' => $request->content,
            'end_date'=> $request->end_date
        ]);

        return $task;
    }

    public function deleteTask($timesheetId, $task){
        $task->timesheets()->detach((int)$timesheetId); 
        return $task->delete();
    }
}