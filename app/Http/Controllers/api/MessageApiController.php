<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\MessageService\MessageService;
use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageApiController extends Controller
{
    public function __construct(
        protected MessageService $messageService,
        Request                  $request
    )
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $chat)
    {

        $data = ['chat_id' => (int)$chat, 'sender_id' => auth()->id(), 'message' => $request->message];
        $message = $this->messageService->create($data);

        broadcast(new SendMessageEvent($message));
        return response()->json(['message' => 'Message sent successfully.'], 200);
    }

}
