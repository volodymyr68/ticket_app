<?php

namespace App\Contracts\Services;

use App\Contracts\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * BaseService constructor.
     *
     * @param BaseRepository $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all records.
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->repository->all();
    }

    /**
     * Get all records paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage = 15)
    {
        return $this->repository->getAllPaginated($perPage);
    }

    /**
     * Find a record by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update a record by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($idOrModel, array $data)
    {
        return $this->repository->update($idOrModel, $data);
    }

    /**
     * Delete a record by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
