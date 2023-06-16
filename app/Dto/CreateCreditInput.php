<?php

namespace App\Dto;


class CreateCreditInput
{
    public function __construct(
        public string $customerName,
        public float $amount,
        public int $term,
    )
    {
    }
}
