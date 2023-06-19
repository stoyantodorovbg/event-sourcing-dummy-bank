<?php

namespace App\Dto\Deposit;

readonly class UpdateDepositable
{
    public function __construct(
        public string $depositableUuid,
        public float $amount,
    )
    {
    }
}
