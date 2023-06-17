<?php

namespace App\Dto;


class CreateCreditInput
{
    public function __construct(
        public string|null $customerName,
        public string|null $customerSerial,
        public float $amount,
        public int $term,
    )
    {
    }
}
