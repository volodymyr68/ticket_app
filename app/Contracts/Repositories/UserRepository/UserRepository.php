<?php

namespace App\Contracts\Repositories\UserRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllClients()
    {
        return User::where('role_id', 1)->get();
    }

    public function getSortedUsers(?array $filters, int $perPage = 10)
    {
        return User::sortable()
            ->when(!empty($filters['role']), function ($query) use ($filters) {
                $query->whereHas('role', function ($q) use ($filters) {
                    $q->where('name', $filters['role']);
                });
            })
            ->when(!empty($filters['sex']), function ($query) use ($filters) {
                $query->where('sex', $filters['sex']);
            })
            ->when(!empty($filters['search']), function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('email', 'like', '%' . $filters['search'] . '%');
                });
            })
            ->paginate($perPage);
    }
}
