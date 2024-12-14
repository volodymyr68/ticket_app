<?php

namespace App\Jobs;

use App\Events\DownloadAdminPdf;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GenerateVehiclePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Vehicle $vehicles
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('pdfs.vehicles', ['vehicles' => $this->vehicles]);
        $filename = 'vehicles_reports' . '.pdf';
        $disk = 'public';
        $pdf->save($filename, $disk);
        $fileUrl = Storage::url($filename);
        Log::info("PDF Generated:" . $fileUrl);
        broadcast(new DownloadAdminPdf($fileUrl));
    }
}
