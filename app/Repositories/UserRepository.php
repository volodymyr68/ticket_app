<?php

namespace App\Contracts\Repositories\UserRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllClients(): Collection
    {
        return User::where('role_id', 1)->get();
    }

    public function getSortedUsers(?array $filters, int $perPage = 10): LengthAwarePaginator
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

    public function getUsersWithoutBonus(): Collection
    {
        return User::whereDoesntHave('bonus')->get();
    }
}
