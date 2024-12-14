<?php

namespace App\Contracts\Services\UserService;

use App\Contracts\Repositories\UserRepository\UserRepository;
use App\Contracts\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
        parent::__construct($userRepository);
    }

    public function getAllClients()
    {
        return $this->userRepository->getAllClients();
    }

    public function getSortedUsers(?array $filters, int $perPage = 10)
    {
        return $this->userRepository->getSortedUsers($filters, $perPage);
    }
}
