<?php

namespace App\Dto\Availability;

use App\Enums\Projections\AvailabilityNames;

readonly class CreateAvailability
{
    public function __construct(
        public string $uuid,
        public AvailabilityNames $name,
        public float $amount,
    )
    {
    }
}
