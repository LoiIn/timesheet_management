<?php

namespace App\Services;

use App\Services\Interfaces\FileServiceInterface;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class FileService extends BaseService implements FileServiceInterface
{
    public function uploadAvatar(Request $request, $domName = ''){
        $avatarName = '';
        if($request->hasFile($domName)){
            $file = $request->file($domName);
            $avatarPath = '/uploads/avatar/';
            $avatarName = time()."-".$file->getClientOriginalName();
            $file->move(public_path().$avatarPath, $avatarName);
        }
        return $avatarName;
    }

    public function exportForUserId($userId, $domName = 'export'){
        return Excel::download(new ReportExport($userId), $domName.'.xlsx');
    }
}