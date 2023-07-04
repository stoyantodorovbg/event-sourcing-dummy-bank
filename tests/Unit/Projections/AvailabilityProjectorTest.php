<?php

namespace Unit\Projections;

use App\Dto\Account\CreateAccount;
use App\Dto\Credit\CreateCredit;
use App\Dto\Deposit\CreateDeposit;
use App\Events\NewAccount;
use App\Events\NewCredit;
use App\Events\NewDeposit;
use App\Projections\Account;
use App\Projections\Customer;
use App\Projectors\DepositProjector;
use Illuminate\Support\Str;
use Tests\TestCase;

class AvailabilityProjectorTest extends TestCase
{
    protected string $projector = DepositProjector::class;

    /** @test */
    public function on_new_deposit(): void
    {
        $dto = new CreateDeposit(
            uuid: Str::uuid(),
            depositableSerial: Account::factory()->create()->serial,
            depositableType: Account::class,
            amount: 12345.22,
            remainder: 0,
            serial: 123456,
            createdAt: now(),
        );

        NewDeposit::dispatch($dto);

        $this->assertDatabaseHas('availabilities', [
            'name' => 'Total Available Amount',
            'amount' => 12345.22,
        ]);
    }

    /** @test */
    public function on_new_account(): void
    {
        $dto = new CreateAccount(
            uuid: Str::uuid(),
            customerSerial: Customer::factory()->create()->serial,
            amount: 2222.22,
            serial: 123456,
            createdAt: now(),
        );

        NewAccount::dispatch($dto);

        $this->assertDatabaseHas('availabilities', [
            'name' => 'Total Available Amount',
            'amount' => 2222.22,
        ]);
    }

    /** @test */
    public function on_new_credit(): void
    {
        $dto = new CreateCredit(
            uuid: Str::uuid(),
            customerSerial: Customer::factory()->create()->serial,
            amount: 333.22,
            term: 12,
            serial: 123456,
            deadline: now()->addYear(),
            createdAt: now(),
        );

        NewCredit::dispatch($dto);

        $this->assertDatabaseHas('availabilities', [
            'name' => 'Total Available Amount',
            'amount' => -333.22,
        ]);
    }
}
