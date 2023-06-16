<?php

namespace App\Repositories\Interfaces;

use App\Projections\Customer;

interface CustomerRepositoryInterface
{
    /**
     * Find a customer by name
     *
     * @param string $name
     * @return Customer|null
     */
    public function findByName(string $name): Customer|null;

    /**
     * Get the customer's total due amount
     *
     * @param string $name
     * @return float
     */
    public function customerTotalDueAmount(string $name): float;
}
