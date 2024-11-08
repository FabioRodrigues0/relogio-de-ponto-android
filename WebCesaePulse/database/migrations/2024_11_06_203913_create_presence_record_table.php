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
        Schema::create('presence_record', function (Blueprint $table) {
            $table->id();
            $table->DATE('date');
            $table->time('entry_time');
            $table->time('exit_time');
            $table->unsignedBigInteger('attendance_mode_id');
            $table->foreign('attendance_mode_id')->references('id')->on('attendance_mode');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_record');
    }
};
