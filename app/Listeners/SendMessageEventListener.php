<?php

namespace App\Listeners;

use App\Events\SendMessageEvent;
use Illuminate\Support\Facades\Log;

class SendMessageEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMessageEvent $event): void
    {
        Log::info('Message received: chat' . $event->message);
    }
}
