<?php

namespace Unit\Actions;

use App\Actions\Interfaces\CreateAccountInterface;
use App\Dto\Account\CreateAccountInput;
use App\Projections\Customer;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    /** @test */
    public function account_data_is_stored_in_db(): void
    {
        $account = resolve(CreateAccountInterface::class)->execute($this->getAccountData());
        $this->assertDatabaseHas('customers', [
            'name' => $account->customer->name,
            'serial' => $account->customer->serial,
        ]);
        $this->assertDatabaseHas('accounts', [
            'amount' => $account->amount,
            'serial' => $account->serial,
        ]);
    }

    /** @test */
    public function a_customer_is_assigned_to_the_account_when_its_serial_is_provided(): void
    {
        $customer = Customer::factory()->create();
        $account = resolve(CreateAccountInterface::class)->execute($this->getAccountData(customerSerial: $customer->serial));
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('accounts', [
            'customer_serial' => $customer->serial,
            'amount' => $account->amount,
            'serial' => $account->serial,
        ]);
    }

    private function getAccountData(
        string $customerName = 'Customer test name',
        string|null $customerSerial = null,
        float $amount = 12345.11,
    ): CreateAccountInput
    {
        return new CreateAccountInput(
            customerName: $customerName,
            customerSerial: $customerSerial,
            amount: $amount,
        );
    }
}
