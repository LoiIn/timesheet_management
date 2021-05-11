<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimeSheet;
use App\Models\Report;
use App\Http\Requests\TimesheetRequest;
use Carbon\Carbon;

class ReportController extends Controller
{   

    public function index(){
        $rs = $this->getReport();
        return view('report.index', ['reports'=>$rs]);
    }

    public function create(){
    }

    public function store(TimesheetRequest $request){
       
    }

    public function edit($id){
        
    }

    public function update(TimesheetRequest $request, $id){
        
    }

    public function insertOrUpdate(TimesheetRequest $request, $id = ''){
        
    }

    public function getReport(){
        $rs =[];
        if(Auth::user()->roles->contains('name','admin')){
            $reports = Report::all();
            $users = User::all();
            $count = 0;
            foreach($users as $user){
                $item = $this->getReportOneUser($user);
                $rs[] = $item;
            }
        }else{
            $rs[] = $this->getReportOneUser(Auth::user());
        }
        return $rs;
    }

    public function getReportOneUser($user){
        $report = Report::find($user->id);
        $rolesStr = convertRolesArrayToString($user->roles);
        $item = [
            'stt' => $user->id,
            'month' => $report == null ? Carbon::now()->month : $report->month,
            'username' => $user->username,
            'roles'  => $rolesStr,
            'regris_time' => $report == null ? 0 : $report->registrations_times,
            'regris_late_time' => $report == null ? 0: $report->registrations_late_times
        ];
        return $item;
    }

}