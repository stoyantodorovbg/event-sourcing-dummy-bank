<?php

namespace App\Dto\Deposit;

use Illuminate\Support\Carbon;

readonly class CreateDeposit
{
    public function __construct(
        public string $uuid,
        public string $depositableSerial,
        public string $depositableType,
        public float $amount,
        public float $remainder,
        public string $serial,
        public Carbon $createdAt,
    )
    {
    }
}
