<?php

namespace App\Dto;

readonly class PayInstallment
{
    public function __construct(
        public string $creditSerial,
        public float $deposit,
    )
    {
    }
}
