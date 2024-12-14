<?php

namespace App\Contracts\Services\CityService;

use App\Contracts\Repositories\CityRepository\CityRepository;
use App\Contracts\Services\BaseService;

class CityService extends BaseService
{

    public function __construct(
        protected CityRepository $cityRepository
    )
    {
        parent::__construct($cityRepository);
    }

    public function getFilteredCities($filter)
    {
        return $this->cityRepository->getFilteredCities($filter);
    }
}
