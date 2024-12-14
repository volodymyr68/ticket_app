<?php

namespace App\Http\Controllers;

use App\Contracts\Services\MessageService\MessageService;
use App\Events\SendMessageEvent;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct(
        protected MessageService $messageService
    )
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Chat $chat)
    {
        $data = ['chat_id' => $chat->id, 'sender_id' => auth()->id(), 'message' => $request->message];
        $message = $this->messageService->create($data);

        broadcast(new SendMessageEvent($message));

        return redirect()->route('chats.show', $chat->id);
    }
}
