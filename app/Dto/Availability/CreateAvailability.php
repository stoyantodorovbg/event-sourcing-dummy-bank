<?php

namespace App\Dto\Availability;

use App\Enums\Projections\AvailabilityName;

readonly class CreateAvailability
{
    public function __construct(
        public string           $uuid,
        public AvailabilityName $name,
        public float            $amount,
    )
    {
    }
}
