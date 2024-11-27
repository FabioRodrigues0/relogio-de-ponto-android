<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleApiController extends Controller
{
    /**
     * Exibir um agendamento específico.
     *
     * @param int $id
     * @param int $month
 */
    public function show($id, $month)
    {

        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $day = 31;
        }elseif ($month == 2 ) {
            $day = 28;
        } else {
            $day = 30;
        }

        $now = Carbon::now();
        $monthStart = Carbon::create($now->year, $month, 1, 0, 0, 0, 'America/Toronto');
        $monthEnd = Carbon::create($now->year, $month, $day, 0, 0, 0, 'America/Toronto');


        $schedule = DB::table('schedule')
            ->where('user_id', $id)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->get();

        if (!$schedule) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        return ScheduleResource::collection($schedule);
    }
}
