<?php

namespace App\Dto;

readonly class CreateDeposit
{
    public function __construct(
        public string $creditSerial,
        public float $deposit,
    )
    {
    }
}
