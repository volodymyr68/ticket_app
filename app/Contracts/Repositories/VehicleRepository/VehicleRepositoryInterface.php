<?php

namespace App\Repositories\VehicleRepository;

interface VehicleRepositoryInterface
{
    public function getVehiclesByFilters($filters);
}
