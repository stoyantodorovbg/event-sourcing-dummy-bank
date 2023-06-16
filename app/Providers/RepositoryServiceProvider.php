<?php

namespace App\Providers;

use App\Repositories\CustomerRepository;
use App\Repositories\CreditRepository;
use App\Repositories\InstallmentRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use App\Repositories\Interfaces\InstallmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CreditRepositoryInterface::class, CreditRepository::class);
    }
}
