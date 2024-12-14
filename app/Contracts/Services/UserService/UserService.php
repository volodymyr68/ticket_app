<?php

namespace App\Services\UserService;

use App\Repositories\UserRepository\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{

    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
