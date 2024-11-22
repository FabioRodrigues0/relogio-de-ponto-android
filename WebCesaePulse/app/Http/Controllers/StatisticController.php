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
    $dailyStatistics = []; // Adicionado para os dados diários

    foreach ($users as $user) {
        // Consulta para obter dados agregados por mês
        $attendance = DB::table('presence_record')
            ->where('user_id', $user->id)
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, entry_time, exit_time)) as total_hours'),
                DB::raw('COUNT(id) as attendance_days')
            )
            ->groupBy('month')
            ->get();

        // Consulta para obter dados agregados por dia
        $dailyAttendance = DB::table('presence_record')
            ->where('user_id', $user->id)
            ->select(
                DB::raw('DATE(date) as day'), // Agrupamento por dia
                DB::raw('COUNT(id) as attendance_count')
            )
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Estrutura para o gráfico diário
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

    // Organizar as estatísticas diárias por data
    ksort($dailyStatistics);

    // Preparar os dados para o gráfico diário
    $chartLabels = array_keys($dailyStatistics); // Dias no eixo X
    $chartValues = array_values($dailyStatistics); // Número de registros no eixo Y

    $getTotalUsers = $this->getUsersNumber();

    return view('admin.allStatistics', compact('userData', 'chartLabels', 'chartValues', 'getTotalUsers'));
}

public function getUsersNumber(){
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    $totalUsers= DB::table('presence_record')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->distinct('user_id')
            ->count();

    return $totalUsers;
}



}


