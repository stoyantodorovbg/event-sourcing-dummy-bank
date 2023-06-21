<?php

namespace Unit\Projections;

use App\Dto\Deposit\CreateDeposit;
use App\Events\NewDeposit;
use App\Projections\Account;
use App\Projections\Deposit;
use App\Projectors\DepositProjector;
use Illuminate\Support\Str;
use Tests\Unit\Projections\BaseProjectorTest;

class DepositProjectorTest extends BaseProjectorTest
{
    protected string $projector = DepositProjector::class;

    /** @test */
    public function on_new_deposit(): void
    {
        $depositable = Account::factory()->create();
        $dto = new CreateDeposit(
            uuid: Str::uuid(),
            depositableSerial: $depositable->serial,
            depositableType: Account::class,
            amount: 12345,
            remainder: 0,
            serial: 123456,
            createdAt: now(),
        );
        $event = new NewDeposit($dto);

        $projector = $this->getProjector();
        $projector->onNewDeposit($event);
        $deposit = Deposit::find($event->attributes->uuid);

        $this->assertSame($dto->uuid, $deposit->uuid);
        $this->assertEquals($dto->depositableSerial, $deposit->depositable_serial);
        $this->assertEquals($dto->depositableType, $deposit->depositable_type);
        $this->assertEquals($dto->serial, $deposit->serial);
        $this->assertEquals($dto->amount, $deposit->amount);
        $this->assertEquals($dto->remainder, $deposit->remainder);
        $this->assertSame($dto->createdAt->toDateTimeString(), $deposit->created_at->toDateTimeString());
    }
}
