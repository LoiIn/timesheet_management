<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseInterface;
use App\Http\Requests\Request;

interface FileServiceInterface extends BaseInterface
{
    public function uploadAvatar(Request $request, $domName);
    public function exportForUserId($userId, $domName = 'export');
}