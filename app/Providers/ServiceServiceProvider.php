<?php

namespace App\Providers;

use App\Services\Operations\Subtract;
use App\Services\Operations\Sum;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind('sum', Sum::class);
        $this->app->bind('subtract', Subtract::class);
    }
}
