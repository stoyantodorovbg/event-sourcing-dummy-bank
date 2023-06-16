<?php

namespace App\Actions\Interfaces;

use App\Projections\Customer;

interface GetCustomerInterface
{
    /**
     * Find a customer by name or create new one
     *
     * @param string $customerName
     * @return Customer
     */
    public function execute(string $customerName): Customer;
}
