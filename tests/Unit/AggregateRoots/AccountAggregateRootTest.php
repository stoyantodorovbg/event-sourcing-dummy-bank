<?php

namespace Unit\AggregateRoots;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\AggregateRoots\AccountAggregateRoot;
use App\Dto\Account\CreateAccount;
use App\Dto\Deposit\CreateDeposit;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewAccount;
use App\Events\NewDeposit;
use App\Events\UpdateAccountDeposit;
use App\Projections\Account;
use App\Projections\Customer;
use App\Projections\Deposit;
use Illuminate\Support\Str;
use Tests\TestCase;

class AccountAggregateRootTest extends TestCase
{
    /** @test */
    public function it_stores_new_account(): void
    {
        $accountData = new CreateAccount(
            uuid: Str::uuid(),
            customerSerial: Customer::factory()->create()->serial,
            amount: 123.22,
            serial: resolve(GetSerialNumberInterface::class)->execute(Account::class),
            createdAt: now(),
        );
        AccountAggregateRoot::fake()
            ->when(fn (AccountAggregateRoot $aggregate) => $aggregate->newAccount($accountData))
            ->assertRecorded(new NewAccount($accountData));
    }

    /** @test */
    public function it_stores_new_deposit(): void
    {
        $depositData = new CreateDeposit(
            uuid: Str::uuid(),
            depositableSerial: Account::factory()->create()->serial,
            depositableType: Account::class,
            amount: 123.22,
            remainder: 0.0,
            serial: resolve(GetSerialNumberInterface::class)->execute(Deposit::class),
            createdAt: now(),
        );
        AccountAggregateRoot::fake()
            ->when(fn (AccountAggregateRoot $aggregate) => $aggregate->newDeposit($depositData))
            ->assertRecorded(new NewDeposit($depositData));
    }

    /** @test */
    public function it_updates_update_credit_deposit(): void
    {
        $data = new UpdateDepositable(
            depositableUuid: Account::factory()->create()->serial,
            amount: 10.00,
        );

        AccountAggregateRoot::fake()
            ->when(fn (AccountAggregateRoot $aggregate) => $aggregate->updateDepositable($data))
            ->assertRecorded(new UpdateAccountDeposit($data));
    }
}
