<?php

namespace App\Actions\CreateProjection\Helpers;

use App\Dto\Customer\GetCustomer;

trait  GetCustomerSerial
{
    protected function getCustomerSerial(string|null $customerSerial, string|null $customerName): string
    {
        $customerData = new GetCustomer(
            customerSerial: $customerSerial,
            customerName: $customerName,
        );

        return $this->getCustomer->execute($customerData)->serial;
    }
}
