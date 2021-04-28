<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;

class PageController extends Controller
{

    public function home(){
        return view('home.index');
    }

    public function getUserProfiles(){
        return view('user.index');
    }

    public function getFormEditUserProfiles(){
        return view('user.edit');
    }

}