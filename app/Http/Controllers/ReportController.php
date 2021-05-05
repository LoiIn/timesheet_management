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
        $reports = Report::all();
        $users = User::all();
        $rs =[];
        $count = 0;
        foreach($users as $user){
            $report = Report::find($user->id);
            $item = [
                'stt' => $user->id,
                'month' => $report == null ? Carbon::now()->month : $report->month,
                'username' => $user->username,
                'regris_time' => $report == null ? 0 : $report->registrations_times,
                'regris_late_time' => $report == null ? 0: $report->registrations_late_times
            ];
            $rs[] = $item;
        }
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

}