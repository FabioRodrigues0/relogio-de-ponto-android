<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttendanceMode;
use App\Models\User;

class PresenceRecord extends Model
{
    protected $table = 'presence_record';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'entry_time',
        'exit_time',
        'attendance_mode_id',
        'user_id'
    ];

    public function attendanceMode()
    {
        return $this->belongsTo(AttendanceMode::class, 'attendance_mode_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
