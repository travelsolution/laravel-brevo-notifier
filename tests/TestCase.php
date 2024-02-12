<?php

namespace TravelSolution\LaravelBrevoNotifier\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use TravelSolution\LaravelBrevoNotifier\BrevoNotifierServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [BrevoNotifierServiceProvider::class];
    }
}
