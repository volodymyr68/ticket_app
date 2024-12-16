<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TicketService\TicketService;
use App\Contracts\Services\VehicleService\VehicleService;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{

    public function __construct(
        protected TicketService  $ticketService,
        protected VehicleService $vehicleService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $this->authorizeAction('viewAny');
        $filters = $request->only(['vehicle_id', 'min_price', 'max_price']);

        $tickets = $this->ticketService->getFilteredTickets($filters);
        $vehicles = $this->vehicleService->getAll();

        return view('tickets.index', compact('tickets', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @return RedirectResponse
     */
    public function store(TicketRequest $request)
    {
        $this->authorizeAction('create');
        $ticket = $this->ticketService->createTicket($request->all());
        return redirect()->route('ticket.show', [$ticket]);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return View
     */
    public function show(Ticket $ticket)
    {
        $this->authorizeAction('view');
        return view('tickets.show', ['ticket' => $ticket]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return RedirectResponse
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('ticket.index');
    }
}
