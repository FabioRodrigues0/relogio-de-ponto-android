<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminHome(){
        if (Auth::user()->users_type_id == 1){
            $userLog = $this->getTodaysEntrances();
            $entrances = $userLog['entrances'];
            $totalHours = $userLog['totalHours'];
            $cont = $userLog['cont'];


            return view('admin.homeAdmin', compact('entrances', 'totalHours', 'cont'));
        }

        else{
            return redirect()->route('login');        }
    }

    public function getTodaysEntrances(){
        $today = Carbon::today();

        $entrances = DB::table('presence_record')
        ->join('users', 'users.id', '=', 'presence_record.user_id')
        ->join('attendance_mode', 'attendance_mode.id', '=', 'presence_record.attendance_mode_id')
        ->whereDate('presence_record.date', $today)
        ->select('users.name',
        'users.foto',
        'presence_record.entry_time',
        'presence_record.date',
        'presence_record.exit_time',
        'attendance_mode.description')
        ->orderBy('presence_record.entry_time', 'desc')
        ->cursorPaginate(5);

        $totalMinutes = 0;
        $cont = 0;

        foreach ($entrances as $presence){

            $entryTime = Carbon::parse($presence->entry_time);
            $exitTime = Carbon::parse($presence->exit_time);
            $timeNow = Carbon::parse(now());



            if($presence->exit_time){
                $presence->total_time = $entryTime->diff($exitTime)->format('%H:%I');
                $durationInMinutes = $entryTime->diffInMinutes($exitTime);
            }
            else{
                $durationInMinutes = $entryTime->diffInMinutes($timeNow);
                $presence->total_time = '';
                $cont ++;
            }
            $totalMinutes += $durationInMinutes;
        }


        $formattedTotalHours = round($totalMinutes/60, 2);
        // dd($formattedTotalHours);
        $casaDecimalInteiro = $formattedTotalHours - floor($totalMinutes/60);
        $casaDecimal = ceil($casaDecimalInteiro*60)/100;

        $numeroInteiro = $formattedTotalHours - $casaDecimalInteiro;

        $finalHour = $numeroInteiro + $casaDecimal;
        return ['entrances' => $entrances, 'totalHours' => $finalHour, 'cont' => $cont];
    }
}
