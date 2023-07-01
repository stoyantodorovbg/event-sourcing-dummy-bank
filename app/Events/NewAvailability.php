<?php

namespace App\Events;

use App\Dto\Availability\CreateAvailability;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewAvailability extends ShouldBeStored
{
    use Dispatchable;

    public function __construct(readonly public CreateAvailability $attributes)
    {
    }
}
