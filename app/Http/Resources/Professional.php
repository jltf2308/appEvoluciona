<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Professional extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'register_number' => $this->register_number,
            'fullName' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'position' => $this->position,
            'dateInit' => date("d-m-Y", strtotime($this->pivot->date_init)),
            'dateEnd' => date("d-m-Y", strtotime($this->pivot->date_end)),
        ];
    }
}
