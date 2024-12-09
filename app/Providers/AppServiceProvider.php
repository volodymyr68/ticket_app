<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\RoleRepository\RoleRepository;
use App\Repositories\TicketRepository\TicketRepository;
use App\Repositories\TicketRepository\TicketRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\VehicleRepository\VehicleRepository;
use App\Services\CityService\CityService;
use App\Services\RoleService\RoleService;
use App\Services\TicketService\TicketService;
use App\Services\UserService\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CityRepository::class, function ($app) {
            return new CityRepository(new City());
        });

        $this->app->singleton(CityService::class, function ($app) {
            return new CityService($app->make(CityRepository::class));
        });
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);

        $this->app->singleton(TicketRepository::class, function ($app) {
            return new TicketRepository(new Ticket());
        });

        $this->app->singleton(TicketService::class, function ($app) {
            return new TicketService(
                $app->make(TicketRepository::class),
                $app->make(VehicleRepository::class)
            );
        });
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->singleton(RoleRepository::class, function ($app) {
            return new RoleRepository(new Role());
        });

        $this->app->singleton(RoleService::class, function ($app) {
            return new RoleService($app->make(RoleRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
