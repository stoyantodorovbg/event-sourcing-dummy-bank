<?php

namespace App\Dto;

readonly class UpdateDepositable
{
    public function __construct(
        public string $depositableUuid,
        public float $amount,
    )
    {
    }
}
