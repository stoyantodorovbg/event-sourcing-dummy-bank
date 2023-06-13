<?php

namespace App\Providers;

use App\Actions\CreateCredit;
use App\Actions\GetBorrower;
use App\Actions\GetPaymentAmount;
use App\Actions\GetPaymentRemainder;
use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\GetBorrowerInterface;
use App\Actions\Interfaces\GetPaymentAmountInterface;
use App\Actions\Interfaces\GetPaymentRemainderInterface;
use App\Actions\Interfaces\PayInstallmentInterface;
use App\Actions\PayInstallment;
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
            abstract: GetBorrowerInterface::class,
            concrete: fn() => resolve(GetBorrower::class, [
                resolve(BorrowerRepositoryInterface::class),
            ])
        );
    }
}
