<?php

namespace Unit\Actions;

use App\Actions\Interfaces\CreateDepositInterface;
use App\Dto\Deposit\CreateDepositInput;
use App\Projections\Credit;
use Tests\TestCase;

class RemainingInstallmentsTest extends TestCase
{
    /** @test */
    public function when_pay_credit_deposit_remaining_installments_column_is_updated_properly(): void
    {
        $credit = Credit::factory()->create([
            'initial_amount' => 1000,
            'amount' => 1000,
            'term' => 10,
            'remaining_installments' => 10,
        ]);
        $depositInput = new CreateDepositInput(
            depositableSerial: $credit->serial,
            depositableType: Credit::class,
            amount: 100,
        );
        resolve(CreateDepositInterface::class)->execute($depositInput);
        $credit = Credit::where('serial', $credit->serial)->first();
        $this->assertSame(9, $credit->remaining_installments);
    }
}
