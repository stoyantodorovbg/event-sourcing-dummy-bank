<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

readonly class CreateCredit
{
    public function __construct(
        public string $uuid,
        public string $customerUuid,
        public float $amount,
        public int $term,
        public string $code,
        public Carbon $deadline,
        public Carbon $createdAt,
    )
    {
    }
}
