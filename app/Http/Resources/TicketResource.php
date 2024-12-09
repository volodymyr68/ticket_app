<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'departure_city' => $this->vehicle->departureCity->name,
            'destination_city' => $this->vehicle->destinationCity->name,
            'seats_taken' => $this->seats_taken,
            'departure_time' => $this->vehicle->departure_time,
            'price' => $this->price,
        ];
    }
}
