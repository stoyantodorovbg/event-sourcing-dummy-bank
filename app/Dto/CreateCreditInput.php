<?php

namespace App\Dto;


class CreateCreditInput
{
    public function __construct(
        public string $borrowerName,
        public float $amount,
        public int $term,
    )
    {
    }
}
