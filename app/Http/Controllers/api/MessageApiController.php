<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\MessageServiceInterface;
use App\Events\SendMessageEvent;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageApiController extends BaseApiController
{
    /**
     * Constructor for MessageApiController.
     *
     * Initializes the controller with necessary dependencies and checks if the request expects JSON.
     * If not, it aborts with a 406 status code.
     *
     * @param MessageService $messageService The service for managing messages.
     * @param Request $request The incoming request.
     */
    public function __construct(
        protected MessageServiceInterface $messageService,
        Request                           $request
    )
    {
        parent::__construct($request);
    }

    /**
     * Stores a new message in the specified chat.
     *
     * This function handles the logic for storing a new message in the database and broadcasting it to the chat.
     * It also validates the incoming request and prepares the necessary data for the message creation.
     *
     * @param Request $request The incoming request containing the message content.
     * @param mixed $chat The identifier of the chat where the message will be sent.
     *
     * @return JsonResponse The response containing a success message and a 200 status code.
     */
    public function store(Request $request, $chat)
    {
        $data = ['chat_id' => (int)$chat, 'sender_id' => auth()->id(), 'message' => $request->message];
        $message = $this->messageService->create($data);

        broadcast(new SendMessageEvent($message));
        return response()->json(['message' => 'Message sent successfully.'], 200);
    }
}
