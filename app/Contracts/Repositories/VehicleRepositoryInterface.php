<?php

namespace App\Contracts\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface VehicleRepositoryInterface
{
    public function getVehiclesByFilters(?array $filters): LengthAwarePaginator;

    public function getSortedVehicles(?array $filters, int $perPage = 10): LengthAwarePaginator;
}
