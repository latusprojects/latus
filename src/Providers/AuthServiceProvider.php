<?php

namespace Latus\Latus\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Latus\Latus\Contracts\Dashboard;
use Latus\Latus\Policies\DashboardPolicy;
use Latus\Permissions\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Dashboard::class => DashboardPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-admin-module', function (User $user) {
            return $user->hasPermission('module.admin');
        });
    }
}