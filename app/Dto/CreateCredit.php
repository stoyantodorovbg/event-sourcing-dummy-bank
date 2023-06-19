<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

readonly class CreateCredit
{
    public function __construct(
        public string $uuid,
        public string $customerSerial,
        public float $initialAmount,
        public float $amount,
        public int $term,
        public string $serial,
        public Carbon $deadline,
        public Carbon $createdAt,
    )
    {
    }
}
