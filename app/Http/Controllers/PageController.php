<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\TimeSheet;

class PageController extends Controller
{

    public function home(){
        return view('home.index');
    }

    // public function getUserProfiles(){
    //     return view('user.index');
    // }

    // public function getFormEditUserProfiles(){
    //     return view('user.edit');
    // }

    public function getTimeSheetList(){
        $user_id = Auth::user()->id;
        $ts_list = User::find($user_id)->timesheets;
        $ts_task_list = [];
        foreach($ts_list as $ts){
            $ts_task_list[$ts->id] = TimeSheet::find($ts->id)->tasks;
        }
        // dd($ts_task_list);
        return view('timesheet.index', ['timesheets'=> $ts_list, 'ts_tasks' => $ts_task_list]);
    }

    public function postTimeSheet($user_id){
        
    }

}