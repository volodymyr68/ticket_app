<?php

namespace App\Contracts\Services\UserService;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserService extends BaseService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
        parent::__construct($userRepository);
    }

    public function getAllClients(): Collection
    {
        return $this->userRepository->getAllClients();
    }

    public function getSortedUsers(?array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->getSortedUsers($filters, $perPage);
    }

    public function getUsersWithoutBonus(): Collection
    {
        return $this->userRepository->getUsersWithoutBonus();
    }
}
