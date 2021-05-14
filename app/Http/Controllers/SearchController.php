<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\User;
use App\Models\Report;
use Carbon\Carbon;

class SearchController extends Controller
{
    function getSearchForReport(Request $request)
    {   
        if($request->get('querys'))
        {
            $querys = $request->get('querys');
            $rs = [];
            $data = [];
            $users = User::where('username', 'LIKE', '%'.$querys[0]. '%')->get();
            
            foreach($users as $user){
                $item = $this->getReportOneUser($user);
                $rs[] = $item;
            }             
            
            if(strcmp($querys[1], 'roles') != 0){
                foreach($rs as $item){
                    if(strpos($item['roles'], $querys[1]) !== false){
                        $data[] = $item;
                    }
                }
            }

            if(strcmp($querys[2], 'month') != 0){
                foreach($rs as $item){
                    if($item['month'] == $querys[2]){
                        $data[] = $item;
                    }
                }
            }

            $reports = [];
            
            if(strcmp($querys[2], 'month') != 0 || strcmp($querys[1], 'roles') != 0) $reports = $data;
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
}
