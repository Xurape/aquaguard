<?php

namespace App\Modules\EnvironmentMetrics\Providers;

use Illuminate\Support\ServiceProvider;

class EnvironmentMetricsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
