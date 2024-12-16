<?php

namespace App\Contracts\Services\TicketService;

use App\Contracts\Repositories\BonusRepositoryInterface;
use App\Contracts\Repositories\TicketRepository\TicketRepository;
use App\Contracts\Repositories\VehicleRepository\VehicleRepository;
use App\Contracts\Services\BaseService;
use App\Mail\TicketBought;
use App\Models\Ticket;
use App\Repositories\BonusRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class TicketService extends BaseService
{

    /**
     * TicketService constructor.
     *
     * Initializes the TicketService with the provided repositories.
     *
     * @param TicketRepository $ticketRepository The repository for managing tickets.
     * @param VehicleRepository $vehicleRepository The repository for managing vehicles.
     * @param BonusRepository $bonusRepository The repository for managing bonuses.
     */
    public function __construct(
        protected TicketRepository  $ticketRepository,
        protected VehicleRepository $vehicleRepository,
        protected BonusRepositoryInterface   $bonusRepository
    )
    {
        parent::__construct($ticketRepository);
    }

    /**
     * Retrieves a list of tickets for a specific user.
     *
     * This function retrieves all tickets associated with the given user ID from the ticket repository.
     *
     * @param int $userId The ID of the user whose tickets are to be retrieved.
     *
     * @return Collection A collection of tickets associated with the given user ID.
     *
     * @throws Exception If an error occurs while retrieving the tickets.
     */
    public function getUserTickets(int $userId): Collection
    {
        return $this->ticketRepository->getTicketsByUser($userId);
    }

    /**
     * Retrieves a list of tickets based on the provided filters.
     *
     * This function retrieves tickets from the ticket repository based on the given filters.
     * The filters can include sorting, pagination, and any other criteria for filtering the tickets.
     *
     * @param array $filters An associative array containing the filters to apply.
     *                       The keys of the array represent the filter names, and the values represent the filter values.
     *                       For example: ['status' => 'active', 'date' => '2022-01-01']
     *
     * @return LengthAwarePaginator A collection of tickets that match the provided filters.
     *               The structure of the returned collection depends on the implementation of the ticket repository.
     *
     * @throws Exception If an error occurs while retrieving the tickets.
     */
    public function getFilteredTickets(array $filters): LengthAwarePaginator
    {
        return $this->ticketRepository->getSortedTickets($filters);
    }


    /**
     * Creates a new ticket for the authenticated user using the provided data.
     *
     * This function handles the creation of a ticket for the authenticated user,
     * including updating vehicle seat quantity, managing user bonuses, and sending a confirmation email.
     *
     * @param array $data An associative array containing the necessary data for creating a ticket.
     *                    The array should include the following keys: 'vehicle_id', 'seats_taken', and 'bonus'.
     *                    'vehicle_id' represents the ID of the vehicle for which the ticket is being created.
     *                    'seats_taken' represents the number of seats being booked.
     *                    'bonus' represents whether the ticket is being created with a bonus (true/false).
     *
     * @return mixed The newly created ticket object.
     *
     * @throws Exception If there are not enough seats available for booking.
     */
    public function createTicketApi(array $data): Ticket
    {
        $data['user_id'] = auth()->user()->id;
        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        if(!$vehicle){
            throw new Exception('Vehicle with ID ' . $data['vehicle_id'] . ' not found ');
        }

        if ($vehicle->seats_quantity - $data['seats_taken'] < 0) {
            throw new Exception('Недостаточно мест для бронирования.');
        }

        $vehicle->seats_quantity -= $data['seats_taken'];
        $this->vehicleRepository->update($vehicle->id, ['seats_quantity' => $vehicle->seats_quantity]);

        $bonus = $this->bonusRepository->getUserBonus();
        $ticket = $this->repository->create($data);

        if ($data['bonus']) {
            $this->bonusRepository->update($bonus, ['amount' => 10.00]);
        } else {
            $this->bonusRepository->update($bonus, ['amount' => $bonus->amount + 10]);
        }

        Mail::to(auth()->user())->send(new TicketBought($ticket, auth()->user()));
        return $ticket;
    }

    /**
     * Creates a new ticket for the authenticated user using the provided data.
     *
     * This function handles the creation of a ticket for the authenticated user,
     * including updating vehicle seat quantity.
     *
     * @param array $data An associative array containing the necessary data for creating a ticket.
     *                    The array should include the following keys: 'vehicle_id', 'seats_taken'.
     *                    'vehicle_id' represents the ID of the vehicle for which the ticket is being created.
     *                    'seats_taken' represents the number of seats being booked.
     *
     * @return mixed The newly created ticket object.
     *
     * @throws Exception If there are not enough seats available for booking.
     */
    public function createTicket(array $data): Ticket
    {
        $data['user_id'] = auth()->user()->id;
        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        if ($vehicle->seats_quantity - $data['seats_taken'] < 0) {
            throw new Exception('Недостаточно мест для бронирования.');
        }
        return $this->repository->create($data);
    }

}
