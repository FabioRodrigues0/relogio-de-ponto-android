<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Listar todos os horários
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    // Exibir um horário específico
    public function show($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        return response()->json($schedule);
    }

    // Criar um novo horário
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'morning_entry_time' => 'required|date_format:H:i:s',
            'morning_exit_time' => 'required|date_format:H:i:s',
            'afternoon_entry_time' => 'required|date_format:H:i:s',
            'afternoon_exit_time' => 'required|date_format:H:i:s',
            'user_id' => 'required|exists:users,id',
            'attendance_mode_id' => 'required|exists:attendance_mode,id',
        ]);

        // Criação do registro de Schedule
        $schedule = Schedule::create($request->all());

        return response()->json($schedule, 201);
    }

    // Atualizar um horário existente
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->update($request->all());

        return response()->json($schedule);
    }

    // Excluir um horário
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully']);
    }
}
