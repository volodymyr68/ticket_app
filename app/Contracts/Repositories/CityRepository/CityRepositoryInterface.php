<?php

namespace App\Contracts\Repositories\CityRepository;

interface CityRepositoryInterface
{
    public function getFilteredCities($filter);
}
