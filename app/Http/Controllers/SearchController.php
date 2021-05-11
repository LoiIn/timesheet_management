<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\User;
use App\Models\Report;
use Carbon\Carbon;

class SearchController extends Controller
{
    function getSearch(SearchRequest $request)
    {   
        if($request->get('query'))
        {
            $query = $request->get('query');
            $type = $request->get('type');
            $data = $this->getReport($query, $type);
            $finalData = [];
            if($type == 'month'){
                foreach($data as $item){
                    if($item['month'] == $query || strpos('month', $query) !== false){
                        $finalData[] = $item;
                    }
                }
            }else if($type == 'role'){
                foreach($data as $item){
                    if(strpos($item['roles'], $query) !== false || strpos('roles', $query) !== false){
                        $finalData[] = $item;
                    }
                }
            }
            else{
                $finalData = $data;
            }

            $output = '';
            foreach($finalData as $row){
                $output .= '
                        <tr>
                        <th scope="row">'.$row['stt'].'</th>
                        <th scope="row">'.$row['month'].'</th>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>'.$row['username'].'</span>
                                </div>
                                <div class="col-lg-3 offset-lg-1 text-right">
                                    <a name="" id="" class="btn btn-default" href="#" role="button">
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>'.$row['roles'].'</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>'.$row['regris_time'].'</</span>
                                </div>
                                <div class="col-lg-3 offset-lg-1 text-right">
                                    <a name="" id="" class="btn btn-default" href="#" role="button">
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>'.$row['regris_late_time'].'</span>
                                </div>
                                <div class="col-lg-3 offset-lg-1 text-right">
                                    <a name="" id="" class="btn btn-default" href="#" role="button">
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a name="" id="" class="btn btn-outline-danger" href="#" role="button" data-toggle="modal" data-target="#report-form-edit">Edit Roles</a>
                                    <a name="" id="" class="btn btn-success" href="{{route('.'members.index' .', [' .'member_id'. '=>'.$row['stt'].'])}}" role="button">Profiles</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                ';
            }
            return $output;
       }
    }

    public function getReport($query = '', $type = ''){
        $rs =[];
        if($type){
            $users = User::all();
        }else{
            $users = empty($query) ? User::all() : User::where('username', 'LIKE', '%'.$query. '%')->get();
        }
        
        foreach($users as $user){
            $item = $this->getReportOneUser($user);
            $rs[] = $item;
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
