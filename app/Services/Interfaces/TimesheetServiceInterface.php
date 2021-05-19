<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\Http\Requests\TimesheetRequest;
use App\Http\Requests\Request;

interface TimesheetServiceInterface extends BaseInterface
{
    public function getAllTimesheet();
    public function getTimesheetsByUser();
    public function getTimesheetById($id);
    public function getTimesheetsByTeam($leaderId);
    public function checkCreatedTimesheet();
    public function createTimesheet(TimesheetRequest $request);
    public function deleteTimesheet($timesheet);
    public function updateTimesheet(Request $request, $id);
    public function getTasksOfTimesheets($timesheets = null);
}