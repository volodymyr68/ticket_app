<?php

namespace App\Listeners;

use App\Events\SendTicketEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTicketEventListener
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
    public function handle(SendTicketEvent $event): void
    {
        Log::info('Message received: ' . $event->url);
    }
}
