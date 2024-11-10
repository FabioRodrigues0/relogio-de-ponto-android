<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminHome(){
        if (Auth::check()){
            return view('admin.homeAdmin');
        }

        else{
            return view("auth.login");
        }
    }
}
