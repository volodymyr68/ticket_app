<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'departure_city_id' => $this->departureCity->id,
            'destination_city_id' => $this->destinationCity->id,
            'departure_city' => $this->departureCity->name,
            'destination_city' => $this->destinationCity->name,
            'seats_quantity' => $this->seats_quantity,
            'ticket_cost' => $this->ticket_cost,
            'departure_time' => $this->departure_time,
        ];
    }
}
