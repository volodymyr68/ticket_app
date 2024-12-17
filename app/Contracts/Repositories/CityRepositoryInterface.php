<?php

namespace App\Contracts\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface CityRepositoryInterface extends BaseRepositoryInterface
{
    public function getFilteredCities(string $filter): LengthAwarePaginator;
}
