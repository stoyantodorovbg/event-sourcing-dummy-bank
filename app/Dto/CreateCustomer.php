<?php

namespace App\Dto;

use Illuminate\Support\Carbon;

readonly class CreateCustomer
{
    public function __construct(
        public string $uuid,
        public string $name,
        public string $serial,
        public Carbon $createdAt,
    ) {

    }
}
