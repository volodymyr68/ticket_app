<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TicketService\TicketService;
use App\Contracts\Services\VehicleService\VehicleService;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

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
     */
    public function index(Request $request)
    {
        $filters = $request->only(['vehicle_id', 'min_price', 'max_price']);

        $tickets = $this->ticketService->getFilteredTickets($filters);
        $vehicles = $this->vehicleService->getAll();

        return view('tickets.index', compact('tickets', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $ticket = $this->ticketService->createTicket($request->all());
        return redirect()->route('ticket.show', [$ticket]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if (!$this->authorize('view', $ticket)) {
            abort(403);
        }
        return view('tickets.show', ['ticket' => $ticket]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('ticket.index');
    }
}
