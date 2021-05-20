<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\Http\Requests\Request;

interface ReportServiceInterface extends BaseInterface
{
    public function getAll();
    public function export($memberId);
    public function create($user);
}