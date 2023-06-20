<?php

namespace App\Events;

use App\Dto\Credit\CreateCredit;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewCredit extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public readonly CreateCredit $attributes)
    {
    }
}
