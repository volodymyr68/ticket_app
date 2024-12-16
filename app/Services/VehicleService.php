<?php

namespace App\Contracts\Services\VehicleService;

use App\Contracts\Repositories\VehicleRepository\VehicleRepository;
use App\Contracts\Services\BaseService;

class VehicleService extends BaseService
{

    public function __construct(
        protected VehicleRepository $vehicleRepository
    )
    {
        parent::__construct($vehicleRepository);
    }

    public function getFilteredVehicles($filters)
    {
        return $this->vehicleRepository->getVehiclesByFilters($filters);
    }

    public function getSortedVehicles(?array $filters, int $perPage = 10)
    {
        return $this->vehicleRepository->getSortedVehicles($filters, $perPage);
    }
}
