<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

readonly class CreateDeposit
{
    public function __construct(
        public string $depositableSerial,
        public string $depositableType,
        public float $amount,
        public string $serial,
        public Carbon $createdAt,
    )
    {
    }
}
