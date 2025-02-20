<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'card_id' => $this->card_id,
            'group_id' => $this->group_id,
            'class' => $this->group->year .'.'. $this->group->class,
        ];
    }
}
