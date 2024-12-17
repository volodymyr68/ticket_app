<?php

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepositoryInterface;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    public function getTicketsByUser(int $userId): Collection
    {
        return Ticket::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getSortedTickets(?array $filters): LengthAwarePaginator
    {
        $query = Ticket::query();

        if (!empty($filters['vehicle_id'])) {
            $query->where('vehicle_id', $filters['vehicle_id']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return $query->sortable()->paginate(10);
    }
}

