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

    public function allStatistics()
    {
        $users = DB::table('users')->get();

        $userData = [];
        $dailyStatistics = [];

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

            $dailyAttendance = DB::table('presence_record')
                ->where('user_id', $user->id)
                ->select(
                    DB::raw('DATE(date) as day'),
                    DB::raw('COUNT(id) as attendance_count')
                )
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            foreach ($dailyAttendance as $record) {
                $day = $record->day;
                if (!isset($dailyStatistics[$day])) {
                    $dailyStatistics[$day] = 0;
                }
                $dailyStatistics[$day] += $record->attendance_count;
            }

            $userData[$user->id] = [
                'name' => $user->name,
                'attendance' => $attendance,
            ];
        }

        ksort($dailyStatistics);

        $chartLabels = array_keys($dailyStatistics);
        $chartValues = array_values($dailyStatistics);

        $getTotalUsers = $this->getUsersNumber();
        $getTotalUsersData = $this->getTotalHours();
        $currentMonth = $this->getCurrentMonth();
        $usersAbsence = $this->usersAbsence();
        

        $totalHours = $getTotalUsersData['totalHours'];
        $totalPresences = $getTotalUsersData['presences'];


        return view('admin.allStatistics', compact('userData', 'chartLabels', 'chartValues', 'getTotalUsers', 'totalHours', 'totalPresences', 'currentMonth', 'usersAbsence'));
    }

    public function getUsersNumber()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $totalUsers = DB::table('presence_record')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->distinct('user_id')
            ->count();

        return $totalUsers;
    }

    public function getCurrentMonth()
    {
        $getCurrentMonth = now()->month;
        switch ($getCurrentMonth) {
            case 1:
                $getCurrentMonth = "Janeiro";
                break;
            case 2:
                $getCurrentMonth = "Fevereiro";
                break;
            case 3:
                $getCurrentMonth = "Março";
                break;
            case 4:
                $getCurrentMonth = "Abril";
                break;
            case 5:
                $getCurrentMonth = "Maio";
                break;
            case 6:
                $getCurrentMonth = "Junho";
                break;
            case 7:
                $getCurrentMonth = "Julho";
                break;
            case 8:
                $getCurrentMonth = "Agosto";
                break;
            case 9:
                $getCurrentMonth = "Setembro";
                break;
            case 10:
                $getCurrentMonth = "Outubro";
                break;
            case 11:
                $getCurrentMonth = "Novembro";
                break;
            case 12:
                $getCurrentMonth = "Dezembro";
                break;
        }

        return $getCurrentMonth;
    }

    public function getTotalHours()
    {

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();


        $entrances = DB::table('presence_record')
            ->join('users', 'users.id', '=', 'presence_record.user_id')
            ->join('attendance_mode', 'attendance_mode.id', '=', 'presence_record.attendance_mode_id')
            ->whereBetween('presence_record.date',  [$monthStart,  $monthEnd])
            ->select(
                'users.name',
                'presence_record.entry_time',
                'presence_record.exit_time',
                'attendance_mode.description'
            )
            ->orderBy('presence_record.date', 'desc')
            ->get();

        $totalMinutes = 0;
        $cont = 0;
        $presences = 0;

        foreach ($entrances as $presence) {
            $entryTime = Carbon::parse($presence->entry_time);
            $exitTime = Carbon::parse($presence->exit_time);
            $timeNow = Carbon::parse(now());

            if ($presence->exit_time) {
                $presence->total_time = $entryTime->diff($exitTime)->format('%H:%I');
                $durationInMinutes = $entryTime->diffInMinutes($exitTime);
            } else {
                $durationInMinutes = $entryTime->diffInMinutes($timeNow);
                $presence->total_time = '';
                $cont++;
            }

            $totalMinutes += $durationInMinutes;
            $presences++;
        }

        $formattedTotalHours = round($totalMinutes / 60, 2);
        $casaDecimalInteiro = $formattedTotalHours - floor($totalMinutes / 60);
        $casaDecimal = ceil($casaDecimalInteiro * 60) / 100;

        $numeroInteiro = $formattedTotalHours - $casaDecimalInteiro;

        $finalHour = $numeroInteiro + $casaDecimal;



        return ['entrances' => $entrances, 'totalHours' => $finalHour, 'cont' => $cont, 'presences' => $presences];
    }

    public function usersAbsence()
    {

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        $today = Carbon::now()->day;
        $totalUserAbsence = 0;

        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $attendanceRecords = DB::table('presence_record')
                ->where('user_id', $user->id)
                ->whereBetween('presence_record.date',  [$monthStart,  $monthEnd])
                ->count();
            $user->totalUserAbsence = $today - $attendanceRecords;
            $totalUserAbsence += $user->totalUserAbsence;
        }

        return $totalUserAbsence;
    }
}
