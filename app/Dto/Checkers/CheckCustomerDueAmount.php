<?php

namespace App\Dto\Checkers;

readonly class CheckCustomerDueAmount
{
    public function __construct(
        public string|null $customerSerial,
        public float $value,
    )
    {

    }
}
