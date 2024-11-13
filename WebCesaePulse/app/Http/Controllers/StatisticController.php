<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function statistics()
    {
        // Fetch all users' attendance data
        $users = DB::table('users')->get(); // Get all users

        // Collect data for each user
        $userData = [];
        foreach ($users as $user) {
            // Aggregate attendance data per month for each user
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

        // Pass the user attendance data to the view
        return view('admin.statistics', compact('userData'));
    }
}


