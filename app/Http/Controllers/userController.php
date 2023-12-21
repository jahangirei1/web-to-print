<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    function showDashboard(){
        return view('user.userDashboard');
    }

    function userLogout(){
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
