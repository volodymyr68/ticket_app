<?php

namespace App\Contracts\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function getAllPaginated(int $perPage = 8): LengthAwarePaginator;

    public function create(array $data): Model;

    public function update($idOrModel, array $data): ?Model;

    public function find(int $id): ?Model;

    public function delete(int $id): ?bool;
}
