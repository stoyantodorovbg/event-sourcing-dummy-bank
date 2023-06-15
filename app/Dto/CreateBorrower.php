<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

readonly class CreateBorrower
{
    public function __construct(
        public string $uuid,
        public string $name,
        public Carbon $createdAt,
    ) {

    }
}
