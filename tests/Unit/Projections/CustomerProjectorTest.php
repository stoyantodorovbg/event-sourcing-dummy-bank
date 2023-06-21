<?php

namespace Unit\Projections;

use App\Dto\Customer\CreateCustomer;
use App\Events\NewCustomer;
use App\Projections\Customer;
use App\Projectors\CustomerProjector;
use Illuminate\Support\Str;
use Tests\Unit\Projections\BaseProjectorTest;

class CustomerProjectorTest extends BaseProjectorTest
{
    protected string $projector = CustomerProjector::class;

    /** @test */
    public function on_new_customer(): void
    {
        $dto = new CreateCustomer(
            uuid: Str::uuid(),
            name: 'Customer names',
            serial: 123456,
            createdAt: now(),
        );
        $event = new NewCustomer($dto);

        $projector = $this->getProjector();
        $projector->onNewCustomer($event);
        $customer = Customer::find($event->attributes->uuid);

        $this->assertSame($dto->uuid, $customer->uuid);
        $this->assertEquals($dto->name, $customer->name);
        $this->assertEquals($dto->serial, $customer->serial);
        $this->assertSame($dto->createdAt->toDateTimeString(), $customer->created_at->toDateTimeString());
    }
}
