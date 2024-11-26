<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $startYear =Carbon::now()->startOfYear();
        $endYear = Carbon::now()->endOfYear();

        foreach ($users as $user) {
            $date = $startYear;
            for ($j = 1; $j <= 365; $j++) {
                $date = $date->addDays(1);
                if($date->isWeekday()){
                    DB::table('schedule')->insert([
                        [
                            'morning_entry_time' => '09:00:00',
                            'morning_exit_time' => '13:00:00',
                            'afternoon_entry_time' => '14:00:00',
                            'afternoon_exit_time' => '18:00:00',
                            'user_id' => $user->id,
                            'attendance_mode_id' => 1,
                            'created_at' => $date,
                            'updated_at' => $date
                        ],
                    ]);
                }
            }
        }
    }
}
