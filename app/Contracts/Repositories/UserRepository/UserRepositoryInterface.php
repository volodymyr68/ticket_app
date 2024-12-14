<?php

namespace App\Contracts\Repositories\UserRepository;

interface UserRepositoryInterface
{
    public function getAllClients();

    public function getSortedUsers(?array $filters, int $perPage = 10);
}
