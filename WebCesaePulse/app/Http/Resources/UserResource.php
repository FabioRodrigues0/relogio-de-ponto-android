<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'foto' => $this->foto,
            'name' => $this->name,
            'email' => $this->email,
            'users_type_id' => $this->users_type_id,
            'setor' => $this->setor
        ];
    }
}
