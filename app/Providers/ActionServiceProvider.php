<?php

namespace App\Providers;

use App\Actions\CreateProjection\CreateAccount;
use App\Actions\CreateProjection\CreateCredit;
use App\Actions\CreateProjection\CreateCustomer;
use App\Actions\CreateProjection\CreateDeposit;
use App\Actions\GetProjection\GetCustomer;
use App\Actions\Interfaces\CreateAccountInterface;
use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\CreateCustomerInterface;
use App\Actions\Interfaces\CreateDepositInterface;
use App\Actions\Interfaces\FormatMoneyInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetDepositAmountInterface;
use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Actions\Interfaces\RemainingInstallmentsInterface;
use App\Actions\ProcessData\Credits\RemainingInstallments;
use App\Actions\ProcessData\Deposits\GetDepositAmount;
use App\Actions\ProcessData\Deposits\GetDepositRemainder;
use App\Actions\ProcessData\Formats\FormatMoney;
use App\Actions\ProcessData\Projections\GetSerialNumber;
use App\Enums\Operation;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\DepositRepositoryInterface;
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
        // Accounts
        $this->app->bind(
            abstract: CreateAccountInterface::class,
            concrete: fn() => resolve(CreateAccount::class, [
                resolve(CustomerRepositoryInterface::class),
                resolve(AccountRepositoryInterface::class),
                resolve(GetCustomerInterface::class),
                resolve(GetSerialNumberInterface::class),
            ])
        );

        // Credits
        $this->app->bind(
            abstract: CreateCreditInterface::class,
            concrete: fn() => resolve(CreateCredit::class, [
                resolve(CustomerRepositoryInterface::class),
                resolve(CreditRepositoryInterface::class),
                resolve(GetCustomerInterface::class),
                resolve(GetSerialNumberInterface::class),
            ])
        );

        // Deposits
        $this->app->bind(
            abstract: CreateDepositInterface::class,
            concrete: fn() => resolve(CreateDeposit::class, [
                resolve(GetDepositRemainderInterface::class),
                resolve(GetSerialNumberInterface::class),
                resolve(DepositRepositoryInterface::class),
            ])
        );
        $this->app->bind(
            abstract: GetDepositRemainderInterface::class,
            concrete: GetDepositRemainder::class,
        );
        $this->app->bind(
            abstract: GetDepositAmountInterface::class,
            concrete: GetDepositAmount::class,
        );

        // Customers
        $this->app->bind(
            abstract: CreateCustomerInterface::class,
            concrete: fn() => resolve(CreateCustomer::class, [
                resolve(CustomerRepositoryInterface::class),
                resolve(GetSerialNumberInterface::class),
            ])
        );

        $this->app->bind(
            abstract: GetCustomerInterface::class,
            concrete: fn() => resolve(GetCustomer::class, [
                resolve(CustomerRepositoryInterface::class),
                resolve(CreateCustomerInterface::class),
            ])
        );
        $this->app->bind(FormatMoneyInterface::class, FormatMoney::class);
        $this->app->bind(GetSerialNumberInterface::class, GetSerialNumber::class);
        $this->app->bind(RemainingInstallmentsInterface::class, RemainingInstallments::class);
    }
}
