<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository;
use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
