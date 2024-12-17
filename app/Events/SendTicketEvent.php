<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendTicketEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public function __construct(
        public $url
    )
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('DownloadTicket');
    }
}
