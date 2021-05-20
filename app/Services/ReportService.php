<?php

namespace App\Services;

use App\Services\Interfaces\ReportServiceInterface;
use App\Services\Interfaces\FileServiceInterface;
use App\Http\Requests\Request;
use App\Models\Report;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportService extends BaseService implements ReportServiceInterface
{
    protected $fileService;

    public function __construct(FileServiceInterface $fileService){
        $this->fileService = $fileService;
    }

    public function getAll(){
        return Report::all();
    }

    public function export($memberId){
        $username = User::find($memberId)->username;
        return $this->fileService->exportForUserId($memberId, 'timesheet-'.$username);
    }

    public function create($user){
        $user->roles()->attach(3);
        $month = Carbon::now('Asia/Ho_Chi_Minh')->month;
        Report::create([
            'month' => $month,
            'user_id' => $user->id,
            'registrations_times' => 0,
            'registrations_late_times' => 0, 
        ]);
    }

}