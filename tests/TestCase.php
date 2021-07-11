<?php


namespace Latus\Latus\Tests;


use Latus\Installer\Installer;
use Latus\Latus\LatusServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Installer::createTestMockup();

    }

    protected function getPackageProviders($app)
    {
        return [
            LatusServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

    }

    protected function getApplicationTimezone($app): string
    {
        return 'Europe/Berlin';
    }
}