<?php

namespace App\Projectors;

use App\Events\NewAvailability;
use App\Events\UpdateAvailability;
use App\Projections\Availability;
use App\Repositories\Interfaces\AvailabilityRepositoryInterface;
use Spatie\EventSourcing\Projections\Projection;
use App\Dto\Availability\UpdateAvailability as UpdateAvailabilityDto;

class AvailabilityProjector extends BaseProjector
{
    protected string $projection = Availability::class;

    public function onNewAvailability(NewAvailability $event): Projection
    {
        return $this->project($event->attributes);
    }

    public function onUpdateAvailability(UpdateAvailability $event): void
    {
        $availability = resolve(AvailabilityRepositoryInterface::class)->findByName($event->attributes->name);
        $amount = resolve($event->attributes->operation->value)->execute(
            input1: $availability->amount,
            input2: $event->attributes->amount
        );

        $this->project(new UpdateAvailabilityDto($amount), $availability);
    }
}
