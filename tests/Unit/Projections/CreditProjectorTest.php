<?php

namespace Unit\Projections;

use App\Dto\Credit\CreateCredit;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewCredit;
use App\Events\UpdateCreditDeposit;
use App\Projections\Credit;
use App\Projections\Customer;
use App\Projectors\CreditProjector;
use Illuminate\Support\Str;
use Tests\Unit\Projections\BaseProjectorTest;

class CreditProjectorTest extends BaseProjectorTest
{
    protected string $projector = CreditProjector::class;

    /** @test */
    public function on_new_credit(): void
    {
        $dto = new CreateCredit(
            uuid: Str::uuid(),
            customerSerial: Customer::factory()->create()->serial,
            amount: 123,
            term: 12,
            serial: 123456,
            deadline: now()->addMonths(12),
            createdAt: now(),
        );
        $event = new NewCredit($dto);

        $projector = $this->getProjector();
        $projector->onNewCredit($event);
        $credit = Credit::find($event->attributes->uuid);

        $this->assertSame($dto->uuid, $credit->uuid);
        $this->assertSame($dto->customerSerial, $credit->customer_serial);
        $this->assertEquals($dto->amount, $credit->amount);
        $this->assertEquals($dto->amount, $credit->initial_amount);
        $this->assertEquals($dto->term, $credit->term);
        $this->assertEquals($dto->term, $credit->remaining_installments);
        $this->assertSame($dto->serial, $credit->serial);
        $this->assertSame($dto->createdAt->toDateTimeString(), $credit->created_at->toDateTimeString());
    }

    /** @test */
    public function on_update_credit_deposit(): void
    {
        $credit = Credit::factory()->create();
        $deposit = 123;
        $dto = new UpdateDepositable(
            depositableUuid: $credit->uuid,
            amount: $deposit,
        );

        $event = new UpdateCreditDeposit($dto);
        $projector = $this->getProjector();
        $projector->onUpdateCreditDeposit($event);

        $newAmount = $credit->amount - $deposit;
        $this->assertDatabaseHas('credits', [
            'uuid' => $credit->uuid,
            'amount' => $newAmount,
            'deposit' => $credit->deposit + $deposit,
            'remaining_installments' => (int) ceil($newAmount / $credit->initial_monthly_installment),
        ]);
    }
}
