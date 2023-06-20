<?php

namespace Unit\Actions;

use App\Actions\Interfaces\CreateCustomerInterface;
use App\Dto\Customer\CreateCustomerInput;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    /** @test */
    public function customer_data_is_stored_in_db(): void
    {
        $customer = resolve(CreateCustomerInterface::class)->execute($this->getCustomerData());
        $this->assertDatabaseHas('customers', [
            'name' => $customer->name,
            'serial' => $customer->serial,
        ]);
    }

    private function getCustomerData(string $customerName = 'Customer test name',): CreateCustomerInput
    {
        return new CreateCustomerInput(
            customerName: $customerName,
        );
    }
}
