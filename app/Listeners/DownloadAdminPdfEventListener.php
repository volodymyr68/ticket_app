<?php

namespace App\Listeners;

use App\Events\DownloadAdminPdf;
use Illuminate\Support\Facades\Log;

class DownloadAdminPdfEventListener
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
    public function handle(DownloadAdminPdf $event): void
    {
        Log::info('Message received: chat' . $event->url);
    }
}
