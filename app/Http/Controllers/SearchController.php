<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\User;
use App\Models\Report;
use App\Models\TimeSheet;
use Carbon\Carbon;

class SearchController extends Controller
{
    function getSearchForReport(Request $request)
    {   
        if($request->get('queries'))
        {
            $queries = $request->get('queries');
            $rs = [];
            $data = [];
            $users = User::where('username', 'LIKE', '%'.$queries[0]. '%')->get();
            
            foreach($users as $user){
                $item = $this->getReportOneUser($user);
                $rs[] = $item;
            }             
            
            if(strcmp($queries[1], 'roles') != 0){
                foreach($rs as $item){
                    if(strpos($item['roles'], $queries[1]) !== false){
                        $data[] = $item;
                    }
                }
            }

            if(strcmp($queries[2], 'month') != 0){
                foreach($rs as $item){
                    if($item['month'] == $queries[2]){
                        $data[] = $item;
                    }
                }
            }

            $reports = [];
            
            if(strcmp($queries[2], 'month') != 0 || strcmp($queries[1], 'roles') != 0) $reports = $data;
            else $reports = $rs;

            $output = view('report.search-result', compact('reports'))->render();
            return $output;
       }
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

    public function getSearchForTimesheet(Request $request){
        if($request->get('queries')){
            $queries = $request->get('queries');
            $users = User::where('username', 'LIKE', '%'.$queries[0]. '%')->get()->pluck('id');

            $startDate = convertFormatDate($queries[1]).' 00:00:00';
            $endDate   = convertFormatDate($queries[2]).' 23:59:59';

            $timesheets = TimeSheet::whereIn('user_id', $users)->whereBetween('created_at', [$startDate, $endDate])->get();
            
            $output = view('timesheet.search-result', compact('timesheets'))->render();
            return $output;
        }
    }
}
