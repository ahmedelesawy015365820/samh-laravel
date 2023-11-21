<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'room' => $this->room,
            'room_id' => $this->room_id,
            'user' => $this->user,
            'user_id' => $this->user_id,
            'agree' => $this->agree,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
