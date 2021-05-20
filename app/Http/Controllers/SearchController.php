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
        $reports = $this->searchService->searchReport($request);
        $output = view('report.search-result', compact('reports'))->render();
        return $output;
    }

    public function getSearchForTimesheet(Request $request){
        $timesheets = $this->searchService->searchReport($request);
        $output = view('timesheet.search-result', compact('timesheets'))->render();
        return $output;
    }
}
