<?php

namespace App\Contracts\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface CityRepositoryInterface
{
    public function getFilteredCities(string $filter): LengthAwarePaginator;
}
