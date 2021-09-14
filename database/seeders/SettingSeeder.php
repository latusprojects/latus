<?php


namespace Latus\Database\Seeders;


use Illuminate\Database\Seeder;
use Latus\Latus\Modules\Contracts\AuthModule;
use Latus\Latus\Modules\Contracts\WebModule;
use Latus\Settings\Services\SettingService;
use Latus\Latus\Modules\Contracts\AdminModule;

class SettingSeeder extends Seeder
{
    public function __construct(
        protected SettingService $settingService
    )
    {
    }

    public const SETTINGS = [
        ['key' => 'active_themes', 'value' => ['latusprojects/latus-2021-theme']],
        ['key' => 'active_modules', 'value' => [
            AdminModule::class => 'Latus\Theme2021\UI\Modules\Admin\AdminModule',
            WebModule::class => 'Latus\Theme2021\UI\Modules\Web\WebModule',
            AuthModule::class => 'Latus\Theme2021\UI\Modules\Auth\AuthModule'
        ]],
        ['key' => 'disabled_modules', 'value' => []],
        ['key' => 'main_repository_name', 'value' => 'latusprojects.repo.repman.io']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::SETTINGS as $setting) {
            if (is_array($setting['value'])) {
                $setting['value'] = json_encode($setting['value']);
            }
            $this->settingService->createSetting($setting);
        }
    }

}