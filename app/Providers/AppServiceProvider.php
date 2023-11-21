<?php

namespace App\Providers;

use App\Repositery\{Role\RoleInterface,
        Role\RoleRepositry,
        RoomType\RoomTypeRepositry,
        User\UserInterface,
        User\UserRepositry,
        Status\StatusInterface,
        Status\StatusRepositry,
        RoomType\RoomTypeInterface,
        Room\RoomInterface,
        Room\RoomRepositry,
        Order\OrderRepositry,
        Order\OrderInterface
    };

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleInterface::class, RoleRepositry::class);
        $this->app->bind(UserInterface::class, UserRepositry::class);
        $this->app->bind(StatusInterface::class, StatusRepositry::class);
        $this->app->bind(RoomTypeInterface::class, RoomTypeRepositry::class);
        $this->app->bind(RoomInterface::class, RoomRepositry::class);
        $this->app->bind(OrderInterface::class, OrderRepositry::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
