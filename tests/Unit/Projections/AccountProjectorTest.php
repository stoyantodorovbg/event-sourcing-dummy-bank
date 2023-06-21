<?php

namespace Unit\Projections;

use App\Dto\Account\CreateAccount;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\UpdateAccountDeposit;
use App\Projections\Account;
use App\Projections\Customer;
use App\Projectors\AccountProjector;
use Illuminate\Support\Str;
use App\Events\NewAccount;
use Tests\Unit\Projections\BaseProjectorTest;


class AccountProjectorTest extends BaseProjectorTest
{
    protected string $projector = AccountProjector::class;

    /** @test */
    public function on_new_account(): void
    {
        $dto = new CreateAccount(
            uuid: Str::uuid(),
            customerSerial: Customer::factory()->create()->serial,
            amount: 123,
            serial: 123456,
            createdAt: now(),
        );
        $event = new NewAccount($dto);

        $projector = $this->getProjector();
        $projector->onNewAccount($event);
        $account = Account::find($event->attributes->uuid);

        $this->assertSame($dto->uuid, $account->uuid);
        $this->assertSame($dto->customerSerial, $account->customer_serial);
        $this->assertEquals($dto->amount, $account->amount);
        $this->assertSame($dto->serial, $account->serial);
        $this->assertSame($dto->createdAt->toDateTimeString(), $account->created_at->toDateTimeString());
    }

    /** @test */
    public function on_update_account_deposit(): void
    {
        $account = Account::factory()->create();
        $deposit = 123;
        $dto = new UpdateDepositable(
            depositableUuid: $account->uuid,
            amount: $deposit,
        );

        $event = new UpdateAccountDeposit($dto);
        $projector = $this->getProjector();
        $projector->onUpdateAccountDeposit($event);

        $this->assertDatabaseHas('accounts', [
            'uuid' => $account->uuid,
            'amount' => $account->amount + $deposit,
        ]);
    }
}
