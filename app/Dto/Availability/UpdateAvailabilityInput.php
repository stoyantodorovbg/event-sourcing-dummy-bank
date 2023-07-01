<?php

namespace App\Dto\Availability;

use App\Enums\Operation;
use App\Enums\Projections\AvailabilityName;

readonly class UpdateAvailabilityInput
{
    public function __construct(
        public AvailabilityName $name,
        public Operation        $operation,
        public float            $amount
    )
    {
    }
}
