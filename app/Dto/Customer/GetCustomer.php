<?php

namespace App\Dto\Customer;

readonly class GetCustomer
{
    public function __construct(
        public string|null $customerSerial,
        public string|null $customerName,
    )
    {
    }
}
