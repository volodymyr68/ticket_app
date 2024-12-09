<?php

namespace App\Services\RoleService;

use App\Repositories\RoleRepository\RoleRepository;
use App\Services\BaseService;

class RoleService extends BaseService
{
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }
}
