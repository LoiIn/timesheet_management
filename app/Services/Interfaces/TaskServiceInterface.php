<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;

interface TaskServiceInterface extends BaseInterface
{
    public function getById($id);
    public function getAllByTimesheetId($timesheetId);
    public function createTask(array $data, $timesheetId);
    public function updateTask(array $data, $id);
    public function deleteTask($timesheetId, $task);
}