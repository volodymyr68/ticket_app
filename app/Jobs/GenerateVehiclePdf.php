<?php

namespace App\Jobs;

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

    protected $vehicles;
    /**
     * Create a new job instance.
     */
    public function __construct($vehicles)
    {
        $this->vehicles = $vehicles;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filename = 'vehicles_reports_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        $disk = 'public';
        $filePath = Storage::disk($disk)->path($filename);

        // Initialize PDF
        $pdf = Pdf::loadView('pdfs.vehicles', ['vehicles' => []]);

        // Paginate vehicles
        $this->vehicles->chunk(20, function ($vehiclesChunk, $pageIndex) use ($pdf) {
            $totalPages = ceil($this->vehicles->count() / 20);  // Total pages calculation
            $html = view('pdfs.vehicles', [
                'vehicles' => $vehiclesChunk,
                'page' => $pageIndex + 1,  // Current page index, starts from 1
                'totalPages' => $totalPages, // Total pages
            ])->render();

            // Add this page's HTML content to the PDF
            $pdf->addPage($html);
        });

        // Save PDF to storage
        $pdf->save($filePath);

        // Generate the URL
        $fileUrl = Storage::url($filename);

        Log::info("PDF Generated: $fileUrl");
    }
}
