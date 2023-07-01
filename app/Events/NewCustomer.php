<?php

namespace App\Events;

use App\Dto\Customer\CreateCustomer;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewCustomer extends ShouldBeStored
{
    use Dispatchable;

    public function __construct(public readonly CreateCustomer $attributes)
    {
    }
}
