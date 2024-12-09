<?php

namespace App\Repositories\TicketRepository;

use App\Models\Ticket;
use App\Repositories\BaseRepository;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model){
        parent::__construct($model);
    }

    public function getTicketsByUser($userId)
    {
        return Ticket::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

