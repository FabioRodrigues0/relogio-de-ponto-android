<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresenceRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'entry_time' => $this->entry_time,
            'exit_time' => $this->exit_time,
            'attendance_mode_id' => $this->attendance_mode_id,
            'user_id' => $this->user_id,
        ];
    }
}
