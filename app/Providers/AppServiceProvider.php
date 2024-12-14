<?php

namespace App\Providers;

use App\Contracts\Repositories\ChatRepository\ChatRepository;
use App\Contracts\Repositories\ChatRepository\ChatRepositoryInterface;
use App\Contracts\Repositories\CityRepository\CityRepository;
use App\Contracts\Repositories\MessageRepository\MessageRepository;
use App\Contracts\Repositories\RoleRepository\RoleRepository;
use App\Contracts\Repositories\TicketRepository\TicketRepository;
use App\Contracts\Repositories\TicketRepository\TicketRepositoryInterface;
use App\Contracts\Repositories\UserRepository\UserRepository;
use App\Contracts\Repositories\VehicleRepository\VehicleRepository;
use App\Contracts\Services\ChatService\ChatService;
use App\Contracts\Services\CityService\CityService;
use App\Contracts\Services\MessageService\MessageService;
use App\Contracts\Services\RoleService\RoleService;
use App\Contracts\Services\TicketService\TicketService;
use App\Contracts\Services\UserService\UserService;
use App\Models\Chat;
use App\Models\City;
use App\Models\Message;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
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

        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);

        $this->app->singleton(ChatRepository::class, function ($app) {
            return new ChatRepository(new Chat());
        });

        $this->app->singleton(ChatService::class, function ($app) {
            return new ChatService($app->make(ChatRepository::class));
        });

        $this->app->singleton(MessageRepository::class, function ($app) {
            return new MessageRepository(new Message());
        });

        $this->app->singleton(MessageService::class, function ($app) {
            return new MessageService($app->make(MessageRepository::class));
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
