<?php

namespace App\Events;

use App\Dto\Deposit\UpdateDepositable;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UpdateAccountDeposit extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public readonly UpdateDepositable $attributes)
    {
    }
}
