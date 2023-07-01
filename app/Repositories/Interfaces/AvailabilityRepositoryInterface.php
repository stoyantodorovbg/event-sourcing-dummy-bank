<?php

namespace App\Repositories\Interfaces;

use App\Enums\Projections\AvailabilityName;
use App\Projections\Availability;

interface AvailabilityRepositoryInterface
{
    /**
     * @param AvailabilityName $name
     * @return Availability
     */
    public function findByName(AvailabilityName $name): Availability;
}
