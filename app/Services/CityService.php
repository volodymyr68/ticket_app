<?php

namespace App\Services;

use App\Contracts\Repositories\CityRepositoryInterface;
use App\Contracts\Services\BaseService;
use App\Contracts\Services\CityServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CityService extends BaseService implements CityServiceInterface
{

    public function __construct(
        protected CityRepositoryInterface $cityRepository
    )
    {
        parent::__construct($cityRepository);
    }

    public function getFilteredCities(string $filter): LengthAwarePaginator
    {
        return $this->cityRepository->getFilteredCities($filter);
    }
}
