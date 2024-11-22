<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'foto' => $this->foto,
            'name' => $this->name,
            'email' => $this->email,
            'user_type' => $this->userType->type,
            'setor' => $this->setor,
            'presences' => $this->presenceRecords->map(function($presence) {
                return [
                    'date' => $presence->date,
                    'entry_time' => $presence->entry_time,
                    'exit_time' => $presence->exit_time,
                    'attendance_mode' => $presence->attendanceMode->description
                    
                ];
            })
        ];
    }
}
