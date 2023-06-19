<?php

namespace App\Events;

use App\Dto\Customer\CreateCustomer;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewCustomer extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public CreateCustomer $attributes)
    {
        //
    }
}
