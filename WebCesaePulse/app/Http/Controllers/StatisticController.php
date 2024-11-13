<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function statistics()
    {
        return view('admin.statistics');
    }
}
