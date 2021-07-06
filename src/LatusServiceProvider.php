<?php

namespace Latus\Latus;

use Illuminate\Support\ServiceProvider;
use Latus\Latus\Models\User;
use Latus\Latus\Repositories\Contracts\UserRepository as UserRepositoryContract;
use Latus\Plugins\Repositories\Eloquent\UserRepository;

class LatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->bound(UserRepositoryContract::class)) {
            $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        }

        if (!$this->app->bound(User::class)) {
            $this->app->bind(User::class, User::class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
