<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SearchServiceInterface;
use App\Http\Requests\Request;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchServiceInterface $searchService){
        $this->searchService = $searchService;
    }

    public function getSearchForReport(Request $request){
        if($request->get('queries')){
            $reports = $this->searchService->searchReport($request->get('queries'));
            $output = view('report.search-result', compact('reports'))->render();
            return $output;
        }
    }

    public function getSearchForTimesheet(Request $request){
        if($request->get('queries')){
            $timesheets = $this->searchService->searchTimesheet($request->get('queries'));
            $output = view('timesheet.search-result', compact('timesheets'))->render();
            return $output;
        }
    }
}
