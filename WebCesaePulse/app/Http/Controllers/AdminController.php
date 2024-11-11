<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminHome(){
        if (Auth::user()->users_type_id == 1){
            return view('admin.homeAdmin');
        }

        else{
            return redirect()->route('login');        }
    }
}
