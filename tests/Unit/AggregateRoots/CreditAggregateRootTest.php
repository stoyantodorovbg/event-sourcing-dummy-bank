<?php

namespace Unit\AggregateRoots;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\AggregateRoots\CreditAggregateRoot;
use App\Dto\Credit\CreateCredit;
use App\Dto\Deposit\CreateDeposit;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewCredit;
use App\Events\NewDeposit;
use App\Events\UpdateCreditDeposit;
use App\Projections\Credit;
use App\Projections\Customer;
use App\Projections\Deposit;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreditAggregateRootTest extends TestCase
{
    /** @test */
    public function it_stores_new_credit(): void
    {
        $creditData = new CreateCredit(
            uuid: Str::uuid(),
            customerSerial: Customer::factory()->create()->serial,
            amount: 123.22,
            term: 12,
            serial: resolve(GetSerialNumberInterface::class)->execute(Credit::class),
            deadline: now()->addMonths(12)->endOfDay(),
            createdAt: now(),
        );
        CreditAggregateRoot::fake()
            ->when(fn (CreditAggregateRoot $aggregate) => $aggregate->newCredit($creditData))
            ->assertRecorded(new NewCredit($creditData));
    }

    /** @test */
    public function it_stores_new_deposit(): void
    {
        $depositData = new CreateDeposit(
            uuid: Str::uuid(),
            depositableSerial: Credit::factory()->create()->serial,
            depositableType: Credit::class,
            amount: 123.22,
            remainder: 0.0,
            serial: resolve(GetSerialNumberInterface::class)->execute(Deposit::class),
            createdAt: now(),
        );
        CreditAggregateRoot::fake()
            ->when(fn (CreditAggregateRoot $aggregate) => $aggregate->newDeposit($depositData))
            ->assertRecorded(new NewDeposit($depositData));
    }

    /** @test */
    public function it_updates_update_credit_deposit(): void
    {
        $data = new UpdateDepositable(
            depositableUuid: Credit::factory()->create()->serial,
            amount: 10.00,
        );

        CreditAggregateRoot::fake()
            ->when(fn (CreditAggregateRoot $aggregate) => $aggregate->updateDepositable($data))
            ->assertRecorded(new UpdateCreditDeposit($data));
    }
}
