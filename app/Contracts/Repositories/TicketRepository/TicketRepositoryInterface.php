<?php

namespace App\Contracts\Repositories\TicketRepository;

interface TicketRepositoryInterface
{
    public function getTicketsByUser($userId);

    public function getSortedTickets($filters);
}
