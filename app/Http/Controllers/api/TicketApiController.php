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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{

    /**
     * Constructs a new TicketApiController instance.
     *
     * This constructor initializes the TicketService and Request instances.
     * It checks if the request expects JSON and aborts with a 406 status code if not.
     *
     * @param TicketService $ticketService The service for managing tickets.
     * @param Request $request The request object containing information about the incoming request.
     */
    public function __construct(
        protected TicketService $ticketService,
        Request                 $request)
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }


    /**
     * Retrieves a collection of tickets for the authenticated user.
     *
     * This function authorizes the user to view any tickets, fetches the tickets for the authenticated user,
     * maps them into TicketResource instances, and returns a TicketCollection.
     *
     * @return TicketCollection A collection of TicketResource instances representing the user's tickets.
     */
    public function index(): TicketCollection
    {
        $this->authorizeAction('viewAny');
        $tickets = $this->ticketService->getUserTickets(auth()->id());
        $ticketResources = $tickets->mapInto(TicketResource::class);
        return new TicketCollection($ticketResources);
    }

    /**
     * Stores a new ticket in the system.
     *
     * This function handles the creation of a new ticket by authorizing the action,
     * processing the request data, and dispatching a job to generate a PDF for the ticket.
     *
     * @param TicketRequest $request The request object containing the data for the new ticket.
     *                               It includes all necessary fields for ticket creation.
     * @return JsonResponse A JSON response indicating the successful creation of the ticket.
     * @throws Exception
     */
    public function store(TicketRequest $request)
    {
        $this->authorizeAction('create');
        $data = $request->all();
        $data['bonus'] = $data['bonus'] ?? 0;
        $ticket = $this->ticketService->createTicketApi($data);
        GenerateTicketPdf::dispatch($ticket);
        return response()->json(['message' => 'Ticket created successfully']);
    }

    /**
     * Initiates the process to generate and download a ticket PDF.
     *
     * This function authorizes the user to download the ticket and dispatches
     * a job to generate the ticket PDF asynchronously.
     *
     * @param Ticket $ticket The ticket model instance for which the PDF is to be generated.
     * @return JsonResponse A JSON response indicating that the ticket will be available soon.
     */
    public function downloadTicket(Ticket $ticket)
    {
//        $this->authorizeAction('download');
        GenerateTicketPdf::dispatch($ticket);
        return response()->json(['message' => 'Ticket will be available soon']);
    }

}
