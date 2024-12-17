<?php

namespace App\Contracts\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseServiceInterface
{
    public function getAll(): Collection;

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator;

    public function getById(int $id): ?Model;

    public function create(array $data): Model;

    public function update($idOrModel, array $data): Model;

    public function delete(int $id): bool;
}
