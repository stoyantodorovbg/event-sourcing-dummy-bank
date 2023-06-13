<?php

namespace App\Dto;

readonly class CreateBorrower
{
    public function __construct(
        public string $name,
    ) {

    }
}
