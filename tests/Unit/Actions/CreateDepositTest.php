<?php

namespace Unit\Actions;

use App\Actions\Interfaces\CreateDepositInterface;
use App\Dto\Deposit\CreateDepositInput;
use App\Projections\Account;
use Tests\TestCase;

class CreateDepositTest extends TestCase
{
    /** @test */
    public function deposit_data_is_stored_in_db(): void
    {
        $account = Account::factory()->create();
        $deposit = resolve(CreateDepositInterface::class)->execute($this->getDepositData($account->serial));

        $this->assertDatabaseHas('deposits', [
            'serial' => $deposit->serial,
            'depositable_serial' => $deposit->depositable->serial,
            'amount' => $deposit->amount,
        ]);
    }

    private function getDepositData(string $depositableSerial, float $amount = 111.11): CreateDepositInput
    {
        return new CreateDepositInput(
            depositableSerial: $depositableSerial,
            depositableType: Account::class,
            amount: $amount,
        );
    }
}
