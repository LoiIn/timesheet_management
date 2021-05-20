<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\Http\Requests\Request;

interface SearchServiceInterface extends BaseInterface
{
    public function searchReport(Request $request);
    public function searchTimesheet(Request $request);
}