<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get all records paginated.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage = 8)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a record by ID.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update($idOrModel, array $data)
    {
        $record = $idOrModel instanceof Model ? $idOrModel : $this->find($idOrModel);
        $record->update($data);
        return $record;
    }

    /**
     * Find a record by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Delete a record by ID.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id)
    {
        $record = $this->find($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }
}
