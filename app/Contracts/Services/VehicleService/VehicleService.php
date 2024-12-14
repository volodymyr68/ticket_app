<?php

namespace App\Services\VehicleService;

use App\Repositories\VehicleRepository\VehicleRepository;
use App\Services\BaseService;

class VehicleService extends BaseService
{
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        parent::__construct($vehicleRepository);
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getFilteredVehicles($filters)
    {
        return $this->vehicleRepository->getVehiclesByFilters($filters);
    }
}
