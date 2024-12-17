<?php

namespace App\Contracts\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllClients(): Collection;

    public function getSortedUsers(?array $filters, int $perPage = 10): LengthAwarePaginator;
}
