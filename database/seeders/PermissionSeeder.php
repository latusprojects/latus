<?php

namespace Latus\Database\Seeders;

use Illuminate\Database\Seeder;
use Latus\Permissions\Services\PermissionService;

class PermissionSeeder extends Seeder
{

    public function __construct(
        protected PermissionService $permissionService
    )
    {
    }

    public const PERMISSIONS = [
        /* Modules */
        ['name' => 'module.admin', 'guard' => 'web'],
        ['name' => 'module.web', 'guard' => 'web'],

        /* Dashboards */
        ['name' => 'dashboard.*', 'guard' => 'web'],
        ['name' => 'dashboard.overview', 'guard' => 'web'],
        ['name' => 'dashboard.statistics', 'guard' => 'web'],

        /* User-Model */
        ['name' => 'user.*', 'guard' => 'web'],
        ['name' => 'user.index', 'guard' => 'web'],
        ['name' => 'user.create', 'guard' => 'web'],
        ['name' => 'user.show', 'guard' => 'web'],
        ['name' => 'user.edit', 'guard' => 'web'],
        ['name' => 'user.destroy', 'guard' => 'web'],

        /* User-Role-Relationship */
        ['name' => 'user.role.*', 'guard' => 'web'],
        ['name' => 'user.role.index', 'guard' => 'web'],
        ['name' => 'user.role.add', 'guard' => 'web'],
        ['name' => 'user.role.show', 'guard' => 'web'],
        ['name' => 'user.role.edit', 'guard' => 'web'],
        ['name' => 'user.role.remove', 'guard' => 'web'],

        /* User-Permission-Relationship */
        ['name' => 'user.permission.*', 'guard' => 'web'],
        ['name' => 'user.permission.index', 'guard' => 'web'],
        ['name' => 'user.permission.add', 'guard' => 'web'],
        ['name' => 'user.permission.show', 'guard' => 'web'],
        ['name' => 'user.permission.edit', 'guard' => 'web'],
        ['name' => 'user.permission.remove', 'guard' => 'web'],

        /* Role-Model */
        ['name' => 'role.*', 'guard' => 'web'],
        ['name' => 'role.index', 'guard' => 'web'],
        ['name' => 'role.create', 'guard' => 'web'],
        ['name' => 'role.show', 'guard' => 'web'],
        ['name' => 'role.edit', 'guard' => 'web'],
        ['name' => 'role.destroy', 'guard' => 'web'],

        /* Role-Permission-Relationship */
        ['name' => 'role.permission.*', 'guard' => 'web'],
        ['name' => 'role.permission.index', 'guard' => 'web'],
        ['name' => 'role.permission.add', 'guard' => 'web'],
        ['name' => 'role.permission.show', 'guard' => 'web'],
        ['name' => 'role.permission.edit', 'guard' => 'web'],
        ['name' => 'role.permission.remove', 'guard' => 'web'],

        /* Permission-Model */
        ['name' => 'permission.*', 'guard' => 'web'],
        ['name' => 'permission.index', 'guard' => 'web'],
        ['name' => 'permission.create', 'guard' => 'web'],
        ['name' => 'permission.show', 'guard' => 'web'],
        ['name' => 'permission.edit', 'guard' => 'web'],
        ['name' => 'permission.destroy', 'guard' => 'web'],

        /* Plugin-Model */
        ['name' => 'plugin.*', 'guard' => 'web'],
        ['name' => 'plugin.index', 'guard' => 'web'],
        ['name' => 'plugin.create', 'guard' => 'web'],
        ['name' => 'plugin.show', 'guard' => 'web'],
        ['name' => 'plugin.edit', 'guard' => 'web'],
        ['name' => 'plugin.destroy', 'guard' => 'web'],

        /* Theme-Model */
        ['name' => 'theme.*', 'guard' => 'web'],
        ['name' => 'theme.index', 'guard' => 'web'],
        ['name' => 'theme.create', 'guard' => 'web'],
        ['name' => 'theme.show', 'guard' => 'web'],
        ['name' => 'theme.edit', 'guard' => 'web'],
        ['name' => 'theme.destroy', 'guard' => 'web'],

        /* ComposerRepository-Model */
        ['name' => 'repository.*', 'guard' => 'web'],
        ['name' => 'repository.index', 'guard' => 'web'],
        ['name' => 'repository.create', 'guard' => 'web'],
        ['name' => 'repository.show', 'guard' => 'web'],
        ['name' => 'repository.edit', 'guard' => 'web'],
        ['name' => 'repository.destroy', 'guard' => 'web'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::PERMISSIONS as $permission) {
            $this->permissionService->createPermission($permission);
        }
    }
}
