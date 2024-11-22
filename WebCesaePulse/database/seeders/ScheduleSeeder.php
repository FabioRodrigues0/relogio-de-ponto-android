<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        DB::table('schedule')->insert([
            [
                'morning_entry_time' => '08:00:00',
                'morning_exit_time' => '12:00:00',
                'afternoon_entry_time' => '13:00:00',
                'afternoon_exit_time' => '17:00:00',
                'user_id' => 4,
                'attendance_mode_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
