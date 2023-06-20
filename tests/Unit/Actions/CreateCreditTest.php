<?php

namespace Unit\Actions;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Dto\Credit\CreateCreditInput;
use App\Projections\Customer;
use Tests\TestCase;

class CreateCreditTest extends TestCase
{
    /** @test */
    public function credit_data_is_stored_in_db(): void
    {
        $credit = resolve(CreateCreditInterface::class)->execute($this->getCreditData());
        $this->assertDatabaseHas('customers', [
            'name' => $credit->customer->name,
            'serial' => $credit->customer->serial,
        ]);
        $this->assertDatabaseHas('credits', [
            'amount' => $credit->amount,
            'serial' => $credit->serial,
            'term' => $credit->term,
        ]);
    }

    /** @test */
    public function a_customer_is_assigned_to_the_credit_when_its_serial_is_provided(): void
    {
        $customer = Customer::factory()->create();
        $credit = resolve(CreateCreditInterface::class)->execute($this->getCreditData(customerSerial: $customer->serial));
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('credits', [
            'customer_serial' => $customer->serial,
            'amount' => $credit->amount,
            'serial' => $credit->serial,
            'term' => $credit->term,
        ]);
    }

    private function getCreditData(
        string $customerName = 'Customer test name',
        string|null $customerSerial = null,
        float $amount = 12345.11,
        int $term = 12,
    ): CreateCreditInput
    {
        return new CreateCreditInput(
            customerName: $customerName,
            customerSerial: $customerSerial,
            amount: $amount,
            term: $term,
        );
    }
}
