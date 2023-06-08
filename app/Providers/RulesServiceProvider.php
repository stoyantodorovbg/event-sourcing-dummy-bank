<?php

namespace App\Providers;

use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use App\Rules\BorrowerMaxAmount;
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
            abstract: 'borrower-max-amount',
            concrete: fn() => resolve(BorrowerMaxAmount::class, [
                resolve(BorrowerRepositoryInterface::class),
            ])
        );
    }
}
