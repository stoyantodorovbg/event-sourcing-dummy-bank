<?php

namespace App\Events;

use App\Dto\Availability\CreateAvailability;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewAvailability extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public CreateAvailability $attributes)
    {
    }
}
