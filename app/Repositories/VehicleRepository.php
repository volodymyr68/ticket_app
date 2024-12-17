<?php

namespace App\Repositories;

use App\Contracts\Repositories\VehicleRepositoryInterface;
use App\Models\Vehicle;
use Illuminate\Pagination\LengthAwarePaginator;

class VehicleRepository extends BaseRepository implements VehicleRepositoryInterface
{
    public function __construct(Vehicle $model)
    {
        parent::__construct($model);
    }

    public function getVehiclesByFilters(?array $filters): LengthAwarePaginator
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

    public function getSortedVehicles(?array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return Vehicle::sortable()
            ->when(!empty($filters['quality']), function ($query) use ($filters) {
                $query->where('quality', 'like', '%' . $filters['quality'] . '%');
            })
            ->when(!empty($filters['departure_city_id']), function ($query) use ($filters) {
                $query->where('departure_city_id', $filters['departure_city_id']);
            })
            ->when(!empty($filters['destination_city_id']), function ($query) use ($filters) {
                $query->where('destination_city_id', $filters['destination_city_id']);
            })
            ->when(!empty($filters['ticket_cost']), function ($query) use ($filters) {
                $query->where('ticket_cost', '<=', $filters['ticket_cost']);
            })
            ->when(!empty($filters['seats_quantity']), function ($query) use ($filters) {
                $query->where('seats_quantity', '>=', $filters['seats_quantity']);
            })
            ->paginate($perPage);
    }
}
