<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimeSheet;
use App\Models\Report;
use App\Models\Team;
use App\Http\Requests\TimesheetRequest;
use Carbon\Carbon;
use App\Services\Interfaces\TimesheetServiceInterface;

class TimesheetController extends Controller
{
    protected $timesheetService;

    public function __construct(TimesheetServiceInterface $timesheetService){
        $this->timesheetService = $timesheetService;
    }

    public function index(){
        $timesheets = $this->timesheetService->getTimesheetsByUser();
        return view('timesheet.index', ['timesheets'=> $timesheets, 'tasks' => $this->timesheetService->getTasksOfTimesheets($timesheets)]);
    }

    public function manage(){
        if($this->authorize('viewAny', TimeSheet::class)){
            $timesheets = Auth::user()->hasRole('admin') ? $this->timesheetService->getAllTimesheet() : $this->timesheetService->getTimesheetsByTeam(Auth::user()->id);
            return view('timesheet.manage', compact('timesheets'));
        }
    }

    public function create(){
        if($this->authorize('create', TimeSheet::class)){
            if(Auth::user()->hasRole('admin')){
                return view('timesheet.timesheet-create');
            }else{
                if($this->timesheetService->checkCreatedTimesheet() == 0){
                    return view('timesheet.timesheet-create');
                }else{
                    return redirect()->route('timesheets.index')->with('ts-action-fail', 'Can only create up to one timesheet per day!');
                }
            }
        }
    }

    public function store(TimesheetRequest $request){
        if($this->timesheetService->createTimesheet($request)){
            return redirect()->route('timesheets.index')->with('ts-action-success', 'A new timesheet was added!');
        }else{
            return view('timesheet.timesheet-create')->with('ts-action-fail', 'Add new timesheet failed!');
        }
    }

    public function edit($id){
        $timesheet = $this->timesheetService->getTimesheetById($id);
        if($this->authorize('update', $timesheet)){
            return view('timesheet.timesheet-edit', compact('timesheet'));
        }
    }

    public function update(TimesheetRequest $request, $id){
        if($this->timesheetService->updateTimesheet($request, $id)){
            return redirect()->route('timesheets.index')->with('ts-action-success', 'The timesheet was updated!');
        }else{
            return view('timesheet.timesheet-create')->with('ts-action-fail', 'Update timesheet fail!');
        }
    }

    public function destroy($id){
        $timesheet = $this->timesheetService->getTimesheetById($id);
        if($this->authorize('delete', $timesheet)){
            $timesheets = $this->timesheetService->getAllTimesheet();
            if($this->timesheetService->deleteTimesheet($timesheet)) redirect()->route('timesheets.manage', compact('timesheets'));
        }
    }
}