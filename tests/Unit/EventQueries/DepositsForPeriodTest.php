<?php

namespace Unit\EventQueries;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\Deposit\CreateDeposit;
use App\Dto\Period\Period;
use App\EventQueries\DepositsForPeriod;
use App\Events\NewDeposit;
use App\Projections\Account;
use App\Projections\Credit;
use Illuminate\Support\Str;
use Tests\Unit\Projections\BaseProjectorTest;

class DepositsForPeriodTest extends BaseProjectorTest
{
    /** @test */
    public function deposits_total_amount_for_a_period(): void
    {
        $now = now();
        $period = new Period($now->copy()->subDays(2), $now->copy()->addDay());
        $getSerialNumber = resolve(GetSerialNumberInterface::class);
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: Account::factory()->create()->serial,
                depositableType: Account::class,
                amount: 100,
                remainder: 10,
                serial: $getSerialNumber->execute(Account::class),
                createdAt: $now,
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: Credit::factory()->create()->serial,
                depositableType: Credit::class,
                amount: 150,
                remainder: 15,
                serial: $getSerialNumber->execute(Credit::class),
                createdAt: $now,
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: Account::factory()->create()->serial,
                depositableType: Account::class,
                amount: 100,
                remainder: 0,
                serial: $getSerialNumber->execute(Account::class),
                createdAt: $now->copy()->subDays(10),
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: Credit::factory()->create()->serial,
                depositableType: Credit::class,
                amount: 100,
                remainder: 0,
                serial: $getSerialNumber->execute(Credit::class),
                createdAt: $now->copy()->subDays(10),
            )
        );

        $query = new DepositsForPeriod($period, Account::class);
        $this->assertSame(90.00, $query->getTotalAmount());

        $query = new DepositsForPeriod($period, Credit::class);
        $this->assertSame(135.00, $query->getTotalAmount());
    }

    /** @test */
    public function depositable_deposits_total_amount_for_a_period(): void
    {
        $now = now();
        $period = new Period($now->copy()->subDays(2), $now->copy()->addDay());

        $account1 = Account::factory()->create();
        $credit1 = Credit::factory()->create();
        $getSerialNumber = resolve(GetSerialNumberInterface::class);
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $account1->serial,
                depositableType: Account::class,
                amount: 100,
                remainder: 10,
                serial: $getSerialNumber->execute(Account::class),
                createdAt: $now,
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $credit1->serial,
                depositableType: Credit::class,
                amount: 150,
                remainder: 15,
                serial: $getSerialNumber->execute(Credit::class),
                createdAt: $now,
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $account1->serial,
                depositableType: Account::class,
                amount: 100,
                remainder: 0,
                serial: $getSerialNumber->execute(Account::class),
                createdAt: $now->copy()->subDays(10),
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $credit1->serial,
                depositableType: Credit::class,
                amount: 100,
                remainder: 0,
                serial: $getSerialNumber->execute(Credit::class),
                createdAt: $now->copy()->subDays(10),
            )
        );

        $account2 = Account::factory()->create();
        $credit2 = Credit::factory()->create();
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $account2->serial,
                depositableType: Account::class,
                amount: 140,
                remainder: 10,
                serial: $getSerialNumber->execute(Account::class),
                createdAt: $now,
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $credit2->serial,
                depositableType: Credit::class,
                amount: 180,
                remainder: 25,
                serial: $getSerialNumber->execute(Credit::class),
                createdAt: $now,
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $account2->serial,
                depositableType: Account::class,
                amount: 100,
                remainder: 0,
                serial: $getSerialNumber->execute(Account::class),
                createdAt: $now->copy()->subDays(10),
            )
        );
        NewDeposit::dispatch(new CreateDeposit(
                uuid: Str::uuid(),
                depositableSerial: $credit2->serial,
                depositableType: Credit::class,
                amount: 100,
                remainder: 0,
                serial: $getSerialNumber->execute(Credit::class),
                createdAt: $now->copy()->subDays(10),
            )
        );

        $query = new DepositsForPeriod($period, Account::class, $account1->serial);
        $this->assertSame(90.00, $query->getTotalAmount());

        $query = new DepositsForPeriod($period, Credit::class, $credit1->serial);
        $this->assertSame(135.00, $query->getTotalAmount());

        $query = new DepositsForPeriod($period, Account::class, $account2->serial);
        $this->assertSame(130.00, $query->getTotalAmount());

        $query = new DepositsForPeriod($period, Credit::class, $credit2->serial);
        $this->assertSame(155.00, $query->getTotalAmount());
    }
}
