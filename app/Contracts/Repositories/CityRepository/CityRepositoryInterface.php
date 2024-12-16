<?php

namespace App\Contracts\Repositories\CityRepository;

use Illuminate\Pagination\LengthAwarePaginator;

interface CityRepositoryInterface
{
    public function getFilteredCities(?array $filter): LengthAwarePaginator;
}
