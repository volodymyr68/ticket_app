<?php

namespace App\Providers;

use App\Events\DownloadAdminPdf;
use App\Events\SendMessageEvent;
use App\Events\SendTicketEvent;
use App\Listeners\DownloadAdminPdfEventListener;
use App\Listeners\SendEventNotification;
use App\Listeners\SendMessageEventListener;
use App\Listeners\SendTicketEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendTicketEvent::class => [
            SendTicketEventListener::class,
        ],
        SendMessageEvent::class => [
            SendMessageEventListener::class,
        ],
        DownloadAdminPdfEventListener::class => [
            DownloadAdminPdf::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
