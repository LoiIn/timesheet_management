<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Report;
use App\Http\Requests\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{   
    public function index(){
        $reports = Report::all();
        return view('report.index', compact('reports'));
    }
    
    public function export($member_id){
        return Excel::download(new ReportExport($member_id), 'timesheet.xlsx');
    }
}