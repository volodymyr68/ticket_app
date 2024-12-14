<?php

namespace App\Contracts\Services\TicketService;

use App\Contracts\Repositories\TicketRepository\TicketRepository;
use App\Contracts\Repositories\VehicleRepository\VehicleRepository;
use App\Contracts\Services\BaseService;
use App\Mail\TicketBought;
use Exception;
use Illuminate\Support\Facades\Mail;

class TicketService extends BaseService
{
    /**
     * TicketService constructor.
     *
     * @param TicketRepository $repository
     */
    public function __construct(
        protected TicketRepository  $ticketRepository,
        protected VehicleRepository $vehicleRepository)
    {
        parent::__construct($ticketRepository);
    }

    public function getUserTickets($userId)
    {
        return $this->ticketRepository->getTicketsByUser($userId);
    }

    public function getFilteredTickets($filters)
    {
        return $this->ticketRepository->getSortedTickets($filters);
    }

    /**
     * @throws Exception
     */
    public function createTicketApi($data)
    {
        $data['user_id'] = auth()->user()->id;
        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        if ($vehicle->seats_quantity - $data['seats_taken'] < 0) {
            throw new Exception('Недостаточно мест для бронирования.');
        }
        $ticket = $this->repository->create($data);
        Mail::to(auth()->user())->send(new TicketBought($ticket, auth()->user()));
        return $ticket;
    }

    public function createTicket($data)
    {
        $data['user_id'] = auth()->user()->id;
        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        if ($vehicle->seats_quantity - $data['seats_taken'] < 0) {
            throw new Exception('Недостаточно мест для бронирования.');
        }
        return $this->repository->create($data);
    }

}