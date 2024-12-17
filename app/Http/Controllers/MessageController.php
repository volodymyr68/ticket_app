<?php

namespace App\Http\Controllers;

use App\Contracts\Services\MessageServiceInterface;
use App\Events\SendMessageEvent;
use App\Models\Chat;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{

    public function __construct(
        protected MessageServiceInterface $messageService
    )
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Chat $chat
     * @return RedirectResponse
     *
     * @throws ValidationException
     *
     * @see MessageService::create
     * @see SendMessageEvent
     * @see \Illuminate\Support\Facades\Redirect::route()
     */
    public function store(Request $request, Chat $chat)
    {
        $data = ['chat_id' => $chat->id, 'sender_id' => auth()->id(), 'message' => $request->message];
        $message = $this->messageService->create($data);

        broadcast(new SendMessageEvent($message));

        return redirect()->route('chats.show', $chat->id);
    }
}
