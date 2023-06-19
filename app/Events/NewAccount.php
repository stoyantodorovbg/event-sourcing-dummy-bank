<?php

namespace App\Events;

use App\Dto\Account\CreateAccount;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewAccount extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public CreateAccount $attributes)
    {
    }
}
