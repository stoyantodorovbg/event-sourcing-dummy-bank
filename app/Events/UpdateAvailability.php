<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;
use App\Dto\Availability\UpdateAvailabilityInput;

class UpdateAvailability extends ShouldBeStored
{
    use Dispatchable;

    public function __construct(public readonly UpdateAvailabilityInput $attributes)
    {
    }
}
