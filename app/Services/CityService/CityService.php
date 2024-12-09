<?php

namespace App\Services\CityService;

use App\Repositories\CityRepository\CityRepository;
use App\Services\BaseService;

class CityService extends BaseService
{
    /**
     * CityService constructor.
     *
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        parent::__construct($repository);
    }
}
