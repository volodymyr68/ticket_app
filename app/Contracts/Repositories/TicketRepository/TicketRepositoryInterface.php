<?php

namespace App\Repositories\TicketRepository;

interface TicketRepositoryInterface
{
    public function getTicketsByUser($userId);
}
