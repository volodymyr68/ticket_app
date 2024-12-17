<?php

namespace App\Repositories;

use App\Contracts\Repositories\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Pagination\LengthAwarePaginator;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function getFilteredCities(string $filter): LengthAwarePaginator
    {
        return City::sortable()
            ->where('name', 'like', '%' . $filter . '%')
            ->paginate(5);
    }
}
