<?php

namespace App\Dto;

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
