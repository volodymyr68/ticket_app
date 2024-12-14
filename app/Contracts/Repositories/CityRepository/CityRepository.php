<?php

namespace App\Contracts\Repositories\CityRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\City;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function getFilteredCities($filter)
    {
        return City::sortable()
            ->where('name', 'like', '%' . $filter . '%')
            ->paginate(5);
    }
}
