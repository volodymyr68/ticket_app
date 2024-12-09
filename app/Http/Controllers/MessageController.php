<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Chat $chat)
    {
        $message = new Message();
        $message->chat_id = $chat->id; // Это гарантирует, что сообщение связано с правильным чатом
        $message->sender_id = auth()->id(); // ID отправителя
        $message->message = $request->message;
        $message->save();

        // broadcast(new SendMessageEvent($message)); // Для реального времени, если нужно

        return redirect()->route('chats.show', $chat->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
