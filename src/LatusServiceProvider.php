<?php

namespace Latus\Latus;

use Illuminate\Support\ServiceProvider;
use Latus\Database\Seeders\DatabaseSeeder;
use Latus\Installer\Providers\Traits\RegistersSeeders;

class LatusServiceProvider extends ServiceProvider
{
    use RegistersSeeders;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSeeders([
            DatabaseSeeder::class
        ]);
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
