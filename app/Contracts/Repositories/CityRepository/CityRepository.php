<?php

namespace App\Repositories\CityRepository;

use App\Models\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    public function __construct(City $model){
        parent::__construct($model);
    }
}
