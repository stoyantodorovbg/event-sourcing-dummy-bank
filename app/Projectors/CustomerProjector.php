<?php

namespace App\Projectors;

use App\Events\NewCustomer;
use App\Projections\Customer;
use Spatie\EventSourcing\Projections\Projection;

class CustomerProjector extends BaseProjector
{
    protected string $projection = Customer::class;

    public function onNewCustomer(NewCustomer $event): Projection
    {
        return $this->project($event->attributes);
    }
}
