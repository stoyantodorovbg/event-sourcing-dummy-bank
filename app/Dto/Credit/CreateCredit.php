<?php

namespace App\Dto\Credit;

use Illuminate\Support\Carbon;

class CreateCredit
{
    public function __construct(
        readonly public string $uuid,
        readonly public string $customerSerial,
        readonly public float $amount,
        readonly public int $term,
        readonly public string $serial,
        readonly public Carbon $deadline,
        readonly public Carbon $createdAt,
        public float|null $initialAmount = null,
    )
    {
    }
}
