<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function statistics()
    {

        $users = DB::table('users')->get();


        $userData = [];
        foreach ($users as $user) {

            $attendance = DB::table('presence_record')
                ->where('user_id', $user->id)
                ->select(
                    DB::raw('MONTH(date) as month'),
                    DB::raw('SUM(TIMESTAMPDIFF(HOUR, entry_time, exit_time)) as total_hours'),
                    DB::raw('COUNT(id) as attendance_days')
                )
                ->groupBy('month')
                ->get();

            $userData[$user->id] = [
                'name' => $user->name,
                'attendance' => $attendance,
            ];
        }


        return view('admin.statistics', compact('userData'));
    }

    public function allStatistics(){

        $users = DB::table('users')->get();


        $userData = [];
        foreach ($users as $user) {

            $attendance = DB::table('presence_record')
                ->where('user_id', $user->id)
                ->select(
                    DB::raw('MONTH(date) as month'),
                    DB::raw('SUM(TIMESTAMPDIFF(HOUR, entry_time, exit_time)) as total_hours'),
                    DB::raw('COUNT(id) as attendance_days')
                )
                ->groupBy('month')
                ->get();

            $userData[$user->id] = [
                'name' => $user->name,
                'attendance' => $attendance,
            ];
        }

        return view('admin.allStatistics', compact('userData'));
    }
}


