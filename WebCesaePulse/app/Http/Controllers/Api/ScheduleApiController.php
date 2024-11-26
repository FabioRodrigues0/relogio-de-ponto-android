<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;

class ScheduleApiController extends Controller
{
    /**
     * Exibir um agendamento específico.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        return response()->json($schedule);
    }
}
