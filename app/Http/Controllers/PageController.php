<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;

class PageController extends Controller
{

    public function home_page(){
        return view('home.index');
    }

    public function get_user_profiles(){
        return view('user.index');
    }

}