<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

class CreateAccount
{
    public function __construct(
        public string $uuid,
        public string $customerSerial,
        public float $amount,
        public string $serial,
        public Carbon $createdAt,
    )
    {
    }
}
