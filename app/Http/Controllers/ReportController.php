<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ReportServiceInterface;
use App\Models\Report;

class ReportController extends Controller
{   
    protected $reportService;

    public function __construct(ReportServiceInterface $reportService){
        $this->reportService = $reportService;
    }

    public function index(){
        $reports = $this->reportService->getAll();
        return view('report.index', compact('reports'));
    }
    
    public function export($memberId){
        return $this->reportService->export($memberId);
    }
}