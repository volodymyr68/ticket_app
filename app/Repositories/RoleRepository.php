<?php

namespace App\Contracts\Repositories\RoleRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
