<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\TimeSheet;
use App\User;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;
    
    function __construct($id){
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array {
    return [
        '#',
        'Username',
        'Problems',
        'Plan',
        'Deleted_date',
        'Created_date',
        'Lastest Update'
    ];
    }

    public function collection(){
        return TimeSheet::where('user_id', $this->id)->get();
    }

    public function map($timesheet): array{
      return [
          $timesheet->id,
          User::find($timesheet->user_id)->username,
          $timesheet->problems,
          $timesheet->plan,
          $timesheet->deleted_at,
          $timesheet->created_at,
          $timesheet->updated_at,
      ];
    }
}
