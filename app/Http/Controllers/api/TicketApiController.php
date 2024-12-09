<?php

namespace App\Http\Controllers\api;

use App\Events\SendTicketEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Jobs\GenerateTicketPdf;
use App\Models\Ticket;
use App\Services\TicketService\TicketService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketApiController extends Controller
{
    /**
     * @var TicketService
     */
    protected $ticketService;

    public function __construct(TicketService $ticketService, Request $request)
    {
        if(!$request->expectsJson()){
            abort(406);
        }
        $this->ticketService = $ticketService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): TicketCollection
    {
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
        $ticket = $this->ticketService->createTicketApi($request->all());
        GenerateTicketPdf::dispatch($ticket);
        return response()->json(['message' => 'Ticket created successfully']);
    }

}
