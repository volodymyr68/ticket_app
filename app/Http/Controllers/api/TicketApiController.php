<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\TicketService\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Jobs\GenerateTicketPdf;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{
    /**
     * @var TicketService
     */
    protected $ticketService;

    public function __construct(TicketService $ticketService, Request $request)
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
        $this->ticketService = $ticketService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): TicketCollection
    {
        $this->authorizeAction('viewAny');
        $tickets = $this->ticketService->getUserTickets(auth()->id());
        $ticketResources = $tickets->mapInto(TicketResource::class);
        return new TicketCollection($ticketResources);
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(TicketRequest $request)
    {
        $this->authorizeAction('create');
        $ticket = $this->ticketService->createTicketApi($request->all());
        GenerateTicketPdf::dispatch($ticket);
        return response()->json(['message' => 'Ticket created successfully']);
    }

    public function downloadTicket(Ticket $ticket)
    {
        $this->authorizeAction('download');
        GenerateTicketPdf::dispatch($ticket);
        return response()->json(['message' => 'Ticket will be available soon']);
    }

}
