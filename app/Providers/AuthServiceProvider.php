<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\City;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Vehicle;
use App\Policies\CityPolicy;
use App\Policies\TicketPolicy;
use App\Policies\VehiclePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        City::class => CityPolicy::class,
        User::class => CityPolicy::class,
        Ticket::class => TicketPolicy::class,
        Vehicle::class => VehiclePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
