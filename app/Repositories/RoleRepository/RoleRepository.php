<?php

namespace App\Repositories\RoleRepository;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model){
        parent::__construct($model);
    }
}
