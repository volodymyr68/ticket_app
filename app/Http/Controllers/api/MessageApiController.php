<?php

namespace App\Http\Controllers\api;

use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->chat_id = $request->id; // Это гарантирует, что сообщение связано с правильным чатом
        $message->sender_id = auth()->id(); // ID отправителя
        $message->message = $request->message;
        $message->save();

        broadcast(new SendMessageEvent($message));
        return response()->json(['message' => 'Message sent successfully.'], 200);
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
