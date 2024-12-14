<?php

namespace App\Contracts\Repositories\VehicleRepository;

interface VehicleRepositoryInterface
{
    public function getVehiclesByFilters($filters);

    public function getSortedVehicles(?array $filters, int $perPage = 10);
}
