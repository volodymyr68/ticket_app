<?php

namespace App\Services;

use App\Contracts\Repositories\VehicleRepositoryInterface;
use App\Contracts\Services\VehicleServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class VehicleService extends BaseService implements VehicleServiceInterface
{

    public function __construct(
        protected VehicleRepositoryInterface $vehicleRepository
    )
    {
        parent::__construct($vehicleRepository);
    }

    public function getFilteredVehicles(array $filters): LengthAwarePaginator
    {
        return $this->vehicleRepository->getVehiclesByFilters($filters);
    }

    public function getSortedVehicles(?array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return $this->vehicleRepository->getSortedVehicles($filters, $perPage);
    }
}
