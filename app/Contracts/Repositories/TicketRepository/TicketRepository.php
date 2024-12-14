<?php

namespace App\Contracts\Repositories\TicketRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\Ticket;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    public function getTicketsByUser($userId)
    {
        return Ticket::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getSortedTickets($filters)
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

