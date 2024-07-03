<?php

namespace App\Modules\WaterMetrics\Providers;

use Illuminate\Support\ServiceProvider;

class WaterMetricsServiceProvider extends ServiceProvider
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
