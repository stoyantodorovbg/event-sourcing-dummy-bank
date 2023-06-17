<?php

namespace App\Actions\Interfaces;

use App\Projections\Customer;

interface GetCustomerInterface
{
    /**
     * Find a customer by serial or create new one
     *
     * @param string|null $customerSerial
     * @param string|null $customerName
     * @return Customer
     */
    public function execute(string|null $customerSerial, string|null $customerName): Customer;
}
