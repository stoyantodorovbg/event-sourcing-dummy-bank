<?php

namespace App\Dto;

use App\Projections\Borrower;

readonly class CreateCredit
{
    public function __construct(
        public string $borrowerUuid,
        public float $amount,
        public int $term,
        public string $code,
        public string $deadline,
    )
    {
    }
}
