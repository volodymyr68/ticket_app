<?php

namespace App\Repositories\VehicleRepository;

use App\Models\City;
use App\Models\Vehicle;
use App\Repositories\BaseRepository;

class VehicleRepository extends BaseRepository implements VehicleRepositoryInterface
{
    public function __construct(Vehicle $model){
        parent::__construct($model);
    }

    public function getVehiclesByFilters($filters)
    {
        $query = Vehicle::query();

        if (isset($filters['departure_city_id'])) {
            $query->where('departure_city_id', $filters['departure_city_id']);
        }
        if (isset($filters['destination_city_id'])) {
            $query->where('destination_city_id', $filters['destination_city_id']);
        }
        if (isset($filters['seats_quantity'])) {
            $query->where('seats_quantity', '>=', $filters['seats_quantity']);
        }
        if (isset($filters['departure_time'])) {
            $query->whereDate('departure_time', '=', $filters['departure_time']);
        }

        if (isset($filters['price_range'])) {
            $query->where('ticket_cost', '<=', $filters['price_range']);
        }
        if (isset($filters['quality'])) {
            $query->where('quality', '=', $filters['quality']);
        }

        if (isset($filters['sort_by_time'])) {
            $query->orderBy('departure_time', $filters['sort_by_time']);
        } else {
            $query->orderBy('departure_time', 'asc');
        }

        $query->with(['departureCity', 'destinationCity']);

        return $query->paginate(9);
    }

}
