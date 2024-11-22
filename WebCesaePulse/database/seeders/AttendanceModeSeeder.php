<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AttendanceModeSeeder extends Seeder
{
    public function run()
    {
        DB::table('attendance_mode')->insert([
            ['description' => 'Online', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Presencial', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Híbrido', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
