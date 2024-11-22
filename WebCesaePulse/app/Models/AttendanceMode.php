<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PresenceRecord;

class AttendanceMode extends Model
{
    protected $table = 'attendance_mode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
    ];

    public function presenceRecords()
    {
        return $this->hasMany(PresenceRecord::class, 'attendance_mode_id');
    }
}
