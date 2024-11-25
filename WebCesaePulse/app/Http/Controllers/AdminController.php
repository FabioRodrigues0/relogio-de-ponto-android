<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminHome(Request $request)
    {


        if (Auth::user()->users_type_id == 1) {

            $selectedDate = $request->input('date', Carbon::now()->format('Y/m/d'));
            $actualDayMonthYear = $selectedDate;

            $registers = $this->getLastRegisters();
            $alerts = $this->alertPanel();
            $userLog = $this->getEntrancesByDate($request->input('date'));
            $userPerformance = $this->usersPerformance();
            $actualMonthYear = Carbon::now()->month . "/" . Carbon::now()->year;

            $entrances = $userLog['entrances'];
            $totalHours = $userLog['totalHours'];
            $cont = $userLog['cont'];
            $presences = $userLog['presences'];
            $totalUserAbsence = $userLog['totalUserAbsence'];


            return view('admin.homeAdmin', compact('entrances', 'totalHours', 'cont', 'presences', 'userPerformance', 'actualMonthYear', 'actualDayMonthYear', 'alerts', 'registers', 'totalUserAbsence'));
        } else {
            return redirect()->route('login');
        }
    }

    public function usersPerformance()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $entrances = DB::table('presence_record')
            ->join('users', 'users.id', '=', 'presence_record.user_id')
            ->whereBetween('presence_record.entry_time', [$monthStart, $monthEnd])
            ->select(
                'users.name',
                'users.setor',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, presence_record.entry_time, presence_record.exit_time)) as total_minutes'),
                DB::raw('
                100 - (AVG(ABS(
                    (HOUR(presence_record.entry_time) * 60 + MINUTE(presence_record.entry_time))
                    - (HOUR(presence_record.entry_time) * 60)
                )) / 60) * 100 AS punctuality_percentage
            ')
            )
            ->groupBy('users.name', 'users.setor')
            ->orderByDesc('total_minutes', 'desc')
            ->get();

        foreach ($entrances as $entry) {
            $hours = floor($entry->total_minutes / 60);
            $minutes = $entry->total_minutes % 60;
            $entry->total_hours = sprintf("%02d:%02d", $hours, $minutes);
        }

        return $entrances;
    }

    public function alertPanel()
    {
        $solicitations = Db::table('password_request')
            ->join('users', 'users.id', '=', 'password_request.users_id')
            ->where('status', 'pending')
            ->orderByDesc('password_request.created_at')
            ->cursorPaginate(5);

        return $solicitations;
    }

    public function concludePasswordRequest($id)
    {
        Db::table('password_request')
            ->where('password_request.users_id', $id)
            ->update([
                'status' => 'completed',
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('message', 'Solicitação marcada como concluída com sucesso!');
    }

    public function getEntrancesByDate($selectedDate = null)
{

    $date = $selectedDate ? Carbon::parse($selectedDate) : Carbon::today();

    $entrances = DB::table('presence_record')
        ->join('users', 'users.id', '=', 'presence_record.user_id')
        ->join('attendance_mode', 'attendance_mode.id', '=', 'presence_record.attendance_mode_id')
        ->whereDate('presence_record.date', $date)
        ->select(
            'users.name',
            'users.foto',
            'presence_record.entry_time',
            'presence_record.date',
            'presence_record.exit_time',
            'attendance_mode.description'
        )
        ->orderBy('presence_record.entry_time', 'desc')
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

    $totalUserAbsence = 0;
    $users = DB::table('users')->get();

    foreach ($users as $user) {
        $attendanceRecords = DB::table('presence_record')
            ->where('user_id', $user->id)
            ->whereDate('presence_record.date',  $date)
            ->count();

            if($attendanceRecords == 0){
                $totalUserAbsence ++;
            }
    }

    return ['entrances' => $entrances, 'totalHours' => $finalHour, 'cont' => $cont, 'presences' => $presences, 'totalUserAbsence' => $totalUserAbsence];
}

public function getLastRegisters(){
    $registers = DB::table('presence_record')
                 ->selectRaw('DATE(date) as day, MAX(date) as latest_date')
                 ->where('date', '>=', now()->subDays(10))
                 ->groupBy('day')
                 ->orderBy('day', 'desc')
                 ->get();

    return $registers;
}

}
