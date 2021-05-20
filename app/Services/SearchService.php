<?php

namespace App\Services;

use App\Services\Interfaces\SearchServiceInterface;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Report;
use App\Models\TimeSheet;
use Carbon\Carbon;

class SearchService extends BaseService implements SearchServiceInterface
{
    public function searchReport(Request $request){   
        if($request->get('queries')){
            $queries = $request->get('queries');
            $rs = [];
            $data = [];
            $userIds = User::where('username', 'LIKE', '%'.$queries[0]. '%')->get()->pluck('id');
            $preReports = [];
            if(strcmp($queries[2], 'month') != 0){
                $preReports = Report::whereIn('user_id', $userIds)->where('month', '=', $queries[2])->get();
            }else{
                $preReports = Report::whereIn('user_id', $userIds)->get();
            }

            $reports = [];
            if(strcmp($queries[1], 'roles') != 0){
                foreach($preReports as $item){
                    $rolesArr = $item->user->roles()->pluck('name')->toArray();
                    if(in_array($queries[1], $rolesArr)){
                        $reports[] = $item;
                    }
                }
            }else{
                $reports = $preReports;
            }

            return $reports;
       }
    }

    public function searchTimesheet(Request $request){
        if($request->get('queries')){
            $queries = $request->get('queries');
            $users = User::where('username', 'LIKE', '%'.$queries[0]. '%')->get()->pluck('id');

            $startDate = convertFormatDate($queries[1]).' 00:00:00';
            $endDate   = convertFormatDate($queries[2]).' 23:59:59';

            $timesheets = TimeSheet::whereIn('user_id', $users)->whereBetween('created_at', [$startDate, $endDate])->get();
            
            return $timesheets;
        }
    }
}