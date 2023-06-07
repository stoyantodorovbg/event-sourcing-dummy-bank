<?php

namespace App\Dto;

use App\Models\Borrower;

readonly class CreateCredit
{
    public function __construct(
        public Borrower $borrower,
        public float $amount,
        public int $term,
        public string $code,
        public string $deadline,
    )
    {
    }
}
