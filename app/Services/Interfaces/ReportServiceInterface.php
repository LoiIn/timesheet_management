<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;

interface ReportServiceInterface extends BaseInterface
{
    public function getAll();
    public function export($memberId);
    public function create($user);
}