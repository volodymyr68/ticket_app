<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ChatService\ChatService;
use App\Contracts\Services\UserService\UserService;
use App\Http\Requests\ChatRequest;
use App\Models\Chat;

class ChatController extends Controller
{
    public function __construct(
        protected ChatService $chatService,
        protected UserService $userService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = $this->chatService->getAll();
        return view("chats.index", compact('chats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChatRequest $request)
    {
        $data = $request->all();
        $data['manager_id'] = auth()->user()->id;
        $this->chatService->create($data);
        return redirect()->route('chats.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = $this->userService->getAllClients();
        return view("chats.create", compact('clients'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $messages = $chat->messages;
        return view("chats.show", compact('chat', 'messages'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();
        return redirect()->route('chats.index');
    }
}
