<?php

namespace App\Dto\Account;

class CreateAccountInput
{
    public function __construct(
        public string|null $customerName,
        public string|null $customerSerial,
        public float $amount,
    )
    {
    }
}
