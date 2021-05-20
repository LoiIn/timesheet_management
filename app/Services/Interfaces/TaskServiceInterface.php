<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\Http\Requests\Request;
use App\Http\Requests\TaskRequest;

interface TaskServiceInterface extends BaseInterface
{
    public function getById($id);
    public function getAllByTimesheetId($timesheetId);
    public function createTask(TaskRequest $request, $timesheetId);
    public function updateTask(Request $request, $id);
    public function deleteTask($timesheetId, $task);
}