<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';
    protected $fillable = [
        'morning_entry_time',
        'morning_exit_time',
        'afternoon_entry_time',
        'afternoon_exit_time',
        'user_id',
        'attendance_mode_id',
    ];

    public $timestamps = true;
}
