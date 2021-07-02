<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;

interface TimesheetServiceInterface extends BaseInterface
{
    public function getAll();
    public function getTimesheetsByUser();
    public function getTimesheetById($id);
    public function getTimesheetsByTeam($leaderId);
    public function checkCreatedTimesheet();
    public function createTimesheet(array $data);
    public function deleteTimesheet($timesheet);
    public function updateTimesheet(array $data, $id);
    public function getTasksOfTimesheets($timesheets = null);
}