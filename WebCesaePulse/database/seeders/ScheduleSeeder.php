<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $countUsers = DB::table('users')->count();

        for ($i = 1; $i <= $countUsers; $i++) {
            DB::table('schedule')->insert([
                [
                    'morning_entry_time' => '09:00:00',
                    'morning_exit_time' => '13:00:00',
                    'afternoon_entry_time' => '14:00:00',
                    'afternoon_exit_time' => '18:00:00',
                    'user_id' => $i,
                    'attendance_mode_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
        }
    }
}
