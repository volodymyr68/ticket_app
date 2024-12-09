<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\Vehicle;
use App\Services\TicketService\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Фильтр по транспорту
        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        // Фильтр по минимальной цене
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Фильтр по максимальной цене
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Сортировка и пагинация
        $tickets = $query->sortable()->paginate(10);

        // Список транспорта для фильтрации
        $vehicles = Vehicle::all();

        return view('tickets.index', compact('tickets', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $ticket = $this->ticketService->createTicket($request->all());
        return redirect()->route('ticket.show',[$ticket]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if(!$this->authorize('view', $ticket)){
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
