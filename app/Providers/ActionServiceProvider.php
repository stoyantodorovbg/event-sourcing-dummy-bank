<?php

namespace App\Providers;

use App\Actions\CreateCredit;
use App\Actions\FormatMoney;
use App\Actions\GetCustomer;
use App\Actions\GetPaymentAmount;
use App\Actions\GetPaymentRemainder;
use App\Actions\GetSerialNumber;
use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\FormatMoneyInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetPaymentAmountInterface;
use App\Actions\Interfaces\GetPaymentRemainderInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Actions\Interfaces\PayInstallmentInterface;
use App\Actions\PayInstallment;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
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
                resolve(CustomerRepositoryInterface::class),
                resolve(CreditRepositoryInterface::class),
                resolve(GetSerialNumberInterface::class),
            ])
        );
        $this->app->bind(
            abstract: GetPaymentRemainderInterface::class,
            concrete: GetPaymentRemainder::class,
        );
        $this->app->bind(
            abstract: GetPaymentAmountInterface::class,
            concrete: GetPaymentAmount::class,
        );
        $this->app->bind(
            abstract: PayInstallmentInterface::class,
            concrete: fn() => resolve(PayInstallment::class, [
                resolve(CreditRepositoryInterface::class),
                resolve(GetPaymentAmountInterface::class),
                resolve(GetPaymentRemainderInterface::class),
            ])
        );
        $this->app->bind(
            abstract: GetCustomerInterface::class,
            concrete: fn() => resolve(GetCustomer::class, [
                resolve(CustomerRepositoryInterface::class),
                resolve(GetSerialNumberInterface::class),
            ])
        );
        $this->app->bind(FormatMoneyInterface::class, FormatMoney::class);
        $this->app->bind(GetSerialNumberInterface::class, GetSerialNumber::class);
    }
}
