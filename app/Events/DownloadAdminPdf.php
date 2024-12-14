<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownloadAdminPdf
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
    public function broadcastOn(): Channel
    {
        return new Channel('DownloadVehicleReport');
    }
}
