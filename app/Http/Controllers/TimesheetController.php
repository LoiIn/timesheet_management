<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request;
use App\Http\Requests\Timesheets\TimesheetRequest;
use App\Services\Interfaces\TimesheetServiceInterface;
use App\Models\TimeSheet;

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
            $timesheets = Auth::user()->hasRole('admin') ? $this->timesheetService->getAll() : $this->timesheetService->getTimesheetsByTeam(Auth::user()->id);
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
        if($this->timesheetService->createTimesheet($request->except('_token'))){
            $request->session()->flash('ts-action-success', 'A new timesheet was added!');
            return redirect()->route('timesheets.index');
        }else{
            $request->session()->flash('ts-action-fail', 'Add new timesheet failed!');
            return view('timesheet.timesheet-create');
        }
    }

    public function edit($id){
        $timesheet = $this->timesheetService->getTimesheetById($id);
        if($this->authorize('update', $timesheet)){
            return view('timesheet.timesheet-edit', compact('timesheet'));
        }
    }

    public function update(TimesheetRequest $request, $id){
        if($this->timesheetService->updateTimesheet($request->except('_token'), $id)){
            $request->session()->flash('ts-action-success', 'The timesheet was updated!');
            return redirect()->route('timesheets.index');
        }else{
            $request->session()->flash('ts-action-fail', 'Update timesheet fail!');
            return view('timesheet.timesheet-create');
        }
    }

    public function destroy(Request $request, $id){
        $timesheet = $this->timesheetService->getTimesheetById($id);
        if($this->authorize('delete', $timesheet)){
            $timesheets = $this->timesheetService->getAll();
            if($this->timesheetService->deleteTimesheet($timesheet)){
                $request->session()->flash('ts-action-success', 'The timesheet was deleted!');
                return redirect()->route('timesheets.manage', compact('timesheets'));
            }else{
                $request->session()->flash('ts-action-fail', 'delete failed');
                return redirect()->route('timesheets.index');
            }
        }
    }
}