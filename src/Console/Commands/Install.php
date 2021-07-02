<?php

namespace Latus\Latus\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Latus\Plugins\PluginManager;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'latus:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guided latus installer, also available as web-installer under <your-website>/install';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Running...');
        try {
            PluginManager::install();
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
        $this->info('Latus has been installed successfully.');

        return 0;
    }
}
