<?php

namespace App\Dto\Customer;

readonly class CreateCustomerInput
{
    public function __construct(
        public string|null $customerName,
    )
    {
    }
}
