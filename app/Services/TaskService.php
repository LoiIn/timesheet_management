<?php

namespace App\Services;

use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSheet;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class TaskService extends BaseService implements TaskServiceInterface
{
    public function getById($id){
        return Task::find($id);
    }

    public function getAllTaskByUser(){
        $timesheets = Auth::user()->timesheets;
        $today = Carbon::now();
        $tasks = [];
        $taskIds = [];     
           
        foreach($timesheets as $ts){
            $taskOfTs = Timesheet::find($ts->id)->tasks()->where('end_date', '>=' , $today)->get()->pluck('id')->toArray();
            $taskIds = array_merge($taskIds, $taskOfTs);
        }

        $ids = array_unique($taskIds);
        foreach($ids as $id){
            $tasks[] = $this->getById($id);
        }
        return $tasks;
    }

    public function getAllByTimesheetId($timesheetId){
        return TimeSheet::find($timesheetId)->tasks;
    }

    public function createTask(array $data, $timesheetId){
        if(Timesheet::find($timesheetId)->tasks()->where('content', '=', \Arr::get($data, 'content'))->first()){
            return false;
        }else{
            $task = Task::where('content', '=', \Arr::get($data, 'content'))->first();
    
            if(!$task){
                $params = [
                    'content'  => \Arr::get($data, 'content'),
                    'end_date' => convertFormatDate(\Arr::get($data, 'end_date'))
                ];
                $newTask = Task::create($params);
                $newTask->timesheets()->attach($timesheetId);
            }else{
                $task->timesheets()->attach($timesheetId);
            }
            
            return true;
        }
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