<?php

namespace Unit\Actions;

use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Dto\Deposit\CreateDepositInput;
use App\Projections\Account;
use App\Projections\Credit;
use Tests\TestCase;

class GetDepositReminderTest extends TestCase
{
    /** @test */
    public function returns_0_when_deposit_dosnt_exceeds_the_allowable_amount(): void
    {
        $account = Account::factory()->create();
        $remainder = $this->getAction()->execute($account, 1000);
        $this->assertSame(0.0, $remainder);
    }

    /** @test */
    public function returns_the_reminder_when_deposit_exceeds_the_allowable_amount(): void
    {
        $credit = Credit::factory()->create();
        $deposit = 80000;
        $remainder = $this->getAction()->execute($credit, $deposit);
        $this->assertSame($deposit - $credit->allowable_amount, $remainder);
    }

    protected function getAction(): GetDepositRemainderInterface
    {
        return resolve(GetDepositRemainderInterface::class);
    }
}
