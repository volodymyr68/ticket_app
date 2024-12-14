<?php

namespace App\Services\TicketService;

use App\Mail\TicketBought;
use App\Repositories\TicketRepository\TicketRepository;
use App\Repositories\VehicleRepository\VehicleRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;

class TicketService extends BaseService
{
    protected $ticketRepository;

    protected $vehicleRepository;

    /**
     * TicketService constructor.
     *
     * @param TicketRepository $repository
     */
    public function __construct(TicketRepository $repository,VehicleRepository $vehicleRepository)
    {
        parent::__construct($repository);
        $this->ticketRepository = $repository;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getUserTickets($userId)
    {
        return $this->ticketRepository->getTicketsByUser($userId);
    }

    /**
     * @throws \Exception
     */
    public function createTicketApi($data)
    {
        $data['user_id'] = auth()->user()->id;
        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        if($vehicle->seats_quantity - $data['seats_taken'] < 0 ){
            throw new \Exception('Недостаточно мест для бронирования.');
        }
        $ticket = $this->repository->create($data);
        Mail::to(auth()->user())->send(new TicketBought($ticket,auth()->user()));
        return $ticket;
    }
    public function createTicket($data)
    {
        $data['user_id'] = auth()->user()->id;
        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        if($vehicle->seats_quantity - $data['seats_taken'] < 0 ){
            throw new \Exception('Недостаточно мест для бронирования.');
        }
        return $this->repository->create($data);
    }

}
