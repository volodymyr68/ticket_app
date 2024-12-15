<?php

namespace App\Providers;

use App\Contracts\Repositories\BonusRepository\BonusRepository;
use App\Contracts\Repositories\ChatRepository\ChatRepository;
use App\Contracts\Repositories\ChatRepository\ChatRepositoryInterface;
use App\Contracts\Repositories\CityRepository\CityRepository;
use App\Contracts\Repositories\MessageRepository\MessageRepository;
use App\Contracts\Repositories\RoleRepository\RoleRepository;
use App\Contracts\Repositories\TicketRepository\TicketRepository;
use App\Contracts\Repositories\TicketRepository\TicketRepositoryInterface;
use App\Contracts\Repositories\UserRepository\UserRepository;
use App\Contracts\Repositories\VehicleRepository\VehicleRepository;
use App\Contracts\Services\BonusService\BonusService;
use App\Contracts\Services\ChatService\ChatService;
use App\Contracts\Services\CityService\CityService;
use App\Contracts\Services\MessageService\MessageService;
use App\Contracts\Services\RoleService\RoleService;
use App\Contracts\Services\TicketService\TicketService;
use App\Contracts\Services\UserService\UserService;
use App\Models\Bonus;
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
        $this->app->bind(CityRepository::class, function ($app) {
            return new CityRepository(new City());
        });

        $this->app->bind(CityService::class, function ($app) {
            return new CityService($app->make(CityRepository::class));
        });

        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);

        $this->app->bind(TicketRepository::class, function ($app) {
            return new TicketRepository(new Ticket());
        });

        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);

        $this->app->bind(ChatRepository::class, function ($app) {
            return new ChatRepository(new Chat());
        });

        $this->app->bind(BonusRepository::class, function ($app) {
            return new BonusRepository(new Bonus());
        });

        $this->app->bind(BonusService::class, function ($app) {
            return new BonusService($app->make(BonusRepository::class));
        });

        $this->app->bind(ChatService::class, function ($app) {
            return new ChatService($app->make(ChatRepository::class));
        });

        $this->app->bind(MessageRepository::class, function ($app) {
            return new MessageRepository(new Message());
        });

        $this->app->bind(MessageService::class, function ($app) {
            return new MessageService($app->make(MessageRepository::class));
        });

        $this->app->bind(TicketService::class, function ($app) {
            return new TicketService(
                $app->make(TicketRepository::class),
                $app->make(VehicleRepository::class),
                $app->make(BonusRepository::class)
            );
        });

        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->bind(RoleRepository::class, function ($app) {
            return new RoleRepository(new Role());
        });

        $this->app->bind(RoleService::class, function ($app) {
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
