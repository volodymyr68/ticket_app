<?php

namespace App\Services;

use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Services\RoleServiceInterface;

class RoleService extends BaseService implements RoleServiceInterface
{
    public function __construct(
        protected RoleRepositoryInterface $roleRepository
    )
    {
        parent::__construct($roleRepository);
    }
}
