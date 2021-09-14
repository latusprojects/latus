<?php

namespace Latus\Latus\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Latus\Database\Seeders\DatabaseSeeder;
use Latus\Installer\Providers\Traits\RegistersSeeders;
use Latus\Latus\Http\Controllers\AdminController;
use Latus\Latus\Http\Controllers\AuthController;
use Latus\Latus\Http\Controllers\WebController;
use Latus\Latus\Modules\Contracts\AdminModule;
use Latus\Latus\Modules\Contracts\AuthModule;
use Latus\Latus\Modules\Contracts\WebModule;
use Latus\UI\Events\AdminNavDefined;
use Latus\UI\Providers\Traits\DefinesModules;

class LatusServiceProvider extends ServiceProvider
{
    use RegistersSeeders, DefinesModules;

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

        $this->defineModules([
            AdminModule::class => [
                'alias' => 'admin',
                'controller' => [AdminController::class, 'showPage'],
            ],
            AuthModule::class => [
                'alias' => 'auth',
                'controller' => AuthController::class,
            ],
            WebModule::class => [
                'alias' => 'web',
                'controller' => WebController::class,
            ],
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../../config/routes.php', 'latus-routes');
    }

    protected function getAdminNavItems(): array
    {
        return [
            ['name' => 'dashboards', 'label' => 'nav.dashboards', 'permissions' => ['dashboard.overview'], 'items' => [
                ['name' => 'dashboard.overview', 'label' => 'nav.dashboards.overview', 'permissions' => ['dashboard.overview'],
                    'url' => url('/admin/dashboard/overview')],
                ['name' => 'dashboard.statistics', 'label' => 'nav.dashboards.statistics', 'permissions' => ['dashboard.statistics'],
                    'url' => url('/admin/dashboard/statistics')]
            ]],

            /* Group: userManagement */
            ['name' => 'users', 'label' => 'nav.users', 'permissions' => ['user.index'], 'group' => 'userManagement', 'items' => [
                ['name' => 'user.index', 'label' => 'nav.users.index', 'permissions' => ['user.index'],
                    'url' => url('/admin/user/index')],
                ['name' => 'user.create', 'label' => 'nav.users.create', 'permissions' => ['user.create'],
                    'url' => url('/admin/user/create')],
            ]],
            ['name' => 'roles', 'label' => 'nav.roles', 'permissions' => ['role.index'], 'group' => 'userManagement', 'items' => [
                ['name' => 'role.index', 'label' => 'nav.roles.index', 'permissions' => ['role.index'],
                    'url' => url('/admin/role/index')],
                ['name' => 'role.create', 'label' => 'nav.roles.create', 'permissions' => ['role.create'],
                    'url' => url('/admin/role/create')],
            ]],
            ['name' => 'permissions', 'label' => 'nav.permissions', 'permissions' => ['permission.index'], 'group' => 'userManagement', 'items' => [
                ['name' => 'permission.index', 'label' => 'nav.permissions.index', 'permissions' => ['permission.index'],
                    'url' => url('/admin/permission/index')],
                ['name' => 'permission.create', 'label' => 'nav.permissions.create', 'permissions' => ['permission.create'],
                    'url' => url('/admin/permission/create')],
            ]],

            /* Group: packageManagement */
            ['name' => 'plugins', 'label' => 'nav.plugins', 'permissions' => ['plugin.index'], 'group' => 'packageManagement', 'items' => [
                ['name' => 'plugin.index', 'label' => 'nav.plugins.index', 'permissions' => ['plugin.index'],
                    'url' => url('/admin/plugin/index')],
                ['name' => 'plugin.create', 'label' => 'nav.plugins.create', 'permissions' => ['plugin.create'],
                    'url' => url('/admin/plugin/create')],
            ]],
            ['name' => 'themes', 'label' => 'nav.themes', 'permissions' => ['theme.index'], 'group' => 'packageManagement', 'items' => [
                ['name' => 'theme.index', 'label' => 'nav.themes.index', 'permissions' => ['theme.index'],
                    'url' => url('/admin/theme/index')],
                ['name' => 'theme.create', 'label' => 'nav.themes.create', 'permissions' => ['theme.create'],
                    'url' => url('/admin/theme/create')],
            ]],
            ['name' => 'repositories', 'label' => 'nav.repositories', 'permissions' => ['repository.index'], 'group' => 'packageManagement', 'items' => [
                ['name' => 'repository.index', 'label' => 'nav.repositories.index', 'permissions' => ['repository.index'],
                    'url' => url('/admin/repository/index')],
                ['name' => 'repository.create', 'label' => 'nav.repositories.create', 'permissions' => ['repository.create'],
                    'url' => url('/admin/repository/create')],
            ]],


        ];
    }

    protected function fillAdminNav()
    {

        Event::listen(function (AdminNavDefined $event) {

            foreach ($this->getAdminNavItems() as $item) {
                $event->adminNav->getItems()->add($item);
            }

        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'latus');

        $this->fillAdminNav();
    }
}
