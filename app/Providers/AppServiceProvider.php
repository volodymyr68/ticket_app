<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(
            'App\Contracts\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\Contracts\Repositories\BonusRepositoryInterface',
            'App\Repositories\BonusRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\ChatRepositoryInterface',
            'App\Repositories\ChatRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\CityRepositoryInterface',
            'App\Repositories\CityRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\MessageRepositoryInterface',
            'App\Repositories\MessageRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\RoleRepositoryInterface',
            'App\Repositories\RoleRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\TicketRepositoryInterface',
            'App\Repositories\TicketRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\VehicleRepositoryInterface',
            'App\Repositories\VehicleRepository'
        );

        //Services
        $this->app->bind(
            'App\Contracts\Services\BonusServiceInterface',
            'App\Services\BonusService'
        );

        $this->app->bind(
            'App\Contracts\Services\ChatServiceInterface',
            'App\Services\ChatService'
        );

        $this->app->bind(
            'App\Contracts\Services\CityServiceInterface',
            'App\Services\CityService'
        );

        $this->app->bind(
            'App\Contracts\Services\MessageServiceInterface',
            'App\Services\MessageService'
        );

        $this->app->bind(
            'App\Contracts\Services\RoleServiceInterface',
            'App\Services\RoleService'
        );

        $this->app->bind(
            'App\Contracts\Services\TicketServiceInterface',
            'App\Services\TicketService'
        );

        $this->app->bind(
            'App\Contracts\Services\UserServiceInterface',
            'App\Services\UserService'
        );

        $this->app->bind(
            'App\Contracts\Services\VehicleServiceInterface',
            'App\Services\VehicleService'
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
