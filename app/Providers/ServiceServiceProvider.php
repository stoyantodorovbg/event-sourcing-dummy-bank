<?php

namespace App\Providers;

use App\Dto\Checkers\CheckCustomerDueAmount;
use App\Services\Checkers\CustomerDueAmountChecker;
use App\Services\Operations\Subtract;
use App\Services\Operations\Sum;
use App\Services\Validators\ValidateParameter;
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

        $this->app->bind(
            abstract: 'customer-due-amount-checker',
            concrete: fn() => new CustomerDueAmountChecker(
                validateParameter: new ValidateParameter(
                    class: CustomerDueAmountChecker::class,
                    expected: CheckCustomerDueAmount::class
                ),
                dto: CheckCustomerDueAmount::class,
            )
        );
    }
}
