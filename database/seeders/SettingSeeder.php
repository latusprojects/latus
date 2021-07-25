<?php


namespace Latus\Database\Seeders;


use Illuminate\Database\Seeder;
use Latus\Settings\Services\SettingService;
use Latus\UI\Modules\Contracts\AdminModule;

class SettingSeeder extends Seeder
{
    public function __construct(
        protected SettingService $settingService
    )
    {
    }

    public const SETTINGS = [
        ['key' => 'active_themes', 'value' => ['latusprojects/latus-2021-theme']],
        ['key' => 'active_modules', 'value' => [AdminModule::class => 'Latus\Theme2021\UI\Modules\Admin']],
        ['key' => 'disabled_modules', 'value' => []]
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
                $setting['value'] = serialize($setting['value']);
            }
            $this->settingService->createSetting($setting);
        }
    }

}