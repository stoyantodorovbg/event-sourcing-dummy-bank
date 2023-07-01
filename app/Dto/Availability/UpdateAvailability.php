<?php

namespace App\Dto\Availability;

readonly class UpdateAvailability
{
    public function __construct(
        public float $amount
    )
    {
    }
}
