<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\ChatService\ChatService;
use App\Contracts\Services\UserService\UserService;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatApiController extends Controller
{
    public function __construct(
        protected ChatService $chatService,
        protected UserService $userService,
        Request               $request
    )
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chat = $this->chatService->getClientChat();
        return response()->json([$chat, "client_id" => auth()->user()->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $messages = $chat->messages;
        return response()->json([$chat, $messages], 200);
    }
}
