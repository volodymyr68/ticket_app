<?php

namespace App\Contracts\Repositories\TicketRepository;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TicketRepositoryInterface
{
    public function getTicketsByUser(int $userId): Collection;

    public function getSortedTickets(?array $filters): LengthAwarePaginator;
}
