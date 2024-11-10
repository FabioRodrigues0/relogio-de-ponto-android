<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_exception', function (Blueprint $table) {
            $table->id();
            $table->time('morning_entry_time');
            $table->time('morning_exit_time');
            $table->time('afternoon_entry_time');
            $table->time('afternoon_exit_time');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedule');
            $table->unsignedBigInteger('attendance_mode_id');
            $table->foreign('attendance_mode_id')->references('id')->on('attendance_mode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_exception');
    }
};
