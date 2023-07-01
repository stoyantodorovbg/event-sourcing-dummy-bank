<?php

namespace App\Projectors;

use App\Events\NewAvailability;
use App\Projections\Availability;
use Spatie\EventSourcing\Projections\Projection;

class AvailabilityProjector extends BaseProjector
{
    protected string $projection = Availability::class;

    public function onNewAvailability(NewAvailability $event): Projection
    {
        return $this->project($event->attributes);
    }
}
