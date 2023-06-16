<?php

namespace App\Providers;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Rules\CustomerMaxDueAmount;
use Illuminate\Support\ServiceProvider;

class RulesServiceProvider extends ServiceProvider
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
        $this->app->bind(
            abstract: 'customer-max-due-amount',
            concrete: fn() => resolve(CustomerMaxDueAmount::class, [
                resolve(CustomerRepositoryInterface::class),
            ])
        );
    }
}
