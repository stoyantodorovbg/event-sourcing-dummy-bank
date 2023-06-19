<?php

namespace App\Dto\Deposit;

class CreateDepositInput
{
    public function __construct(
        public string $depositableSerial,
        public string $depositableType,
        public float $amount,
    )
    {
    }
}
