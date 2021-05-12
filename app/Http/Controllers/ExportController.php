<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\TimeSheet;
use App\User;

class ExportController extends Controller
{
    public function exportCsv(Request $request){
        $fileName = 'timesheet.csv';
        $timesheets = TimeSheet::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('problems', 'plan');

        $callback = function() use($timesheets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($timesheets as $ts) {
                $row['username']  = User::find($ts->user_id)->username;
                $row['problems']  = $ts->problems;
                $row['plan']      = $ts->plan;

                fputcsv($file, array($row['username'], $row['problems'], $row['plan']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
