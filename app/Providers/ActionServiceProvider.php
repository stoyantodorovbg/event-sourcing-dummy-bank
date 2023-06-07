<?php

namespace App\Providers;

use App\Actions\CreateCredit;
use App\Actions\Interfaces\CreateCreditInterface;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
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
            abstract: CreateCreditInterface::class,
            concrete: fn() => resolve(CreateCredit::class, [
                resolve(BorrowerRepositoryInterface::class),
                resolve(CreditRepositoryInterface::class),
            ])
        );
    }
}
