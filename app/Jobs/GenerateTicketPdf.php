<?php

namespace App\Jobs;

use App\Events\SendTicketEvent;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GenerateTicketPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Ticket $ticket
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('pdfs.ticket', ['ticket' => $this->ticket]);
        $filename = 'ticket_report' . now()->format('Y-m-d_H-i-s') . '.pdf';
        $disk = 'public';
        $pdf->save($filename, $disk);
        $fileUrl = Storage::url($filename);
        $this->ticket->url = $fileUrl;
        $this->ticket->save();
        $APP_URL='http://localhost:8080';
        $downloadUrl = $APP_URL . $fileUrl;
        broadcast(new SendTicketEvent($downloadUrl));
    }
}
