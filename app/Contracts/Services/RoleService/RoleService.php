<?php

namespace App\Contracts\Services\RoleService;

use App\Contracts\Repositories\RoleRepository\RoleRepository;
use App\Contracts\Services\BaseService;

class RoleService extends BaseService
{
    public function __construct(
        protected RoleRepository $roleRepository
    )
    {
        parent::__construct($roleRepository);
    }
}
