<?php

namespace App\Services;

use App\Services\Interfaces\TaskServiceInterface;
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

    public function createTask(array $data, $timesheetId){
        $params = [
            'content'  => \Arr::get($data, 'content'),
            'end_date' => convertFormatDate(\Arr::get($data, 'end_date'))
        ];
        $task = Task::create($params);

        if($task){
            $task->timesheets()->attach($timesheetId);
            return true;
        }

        return false;
    }

    public function updateTask(array $data, $id){        
        $task = Task::find($id);
        $params = [
            'content' => \Arr::get($data, 'content'),
            'end_date'=> \Arr::get($data, 'end_date')
        ];

        return $task->update($params);
    }

    public function deleteTask($timesheetId, $task){
        $task->timesheets()->detach((int)$timesheetId); 
        return $task->delete();
    }
}