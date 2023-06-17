<?php

namespace App\Actions\Interfaces;

use App\Projections\Customer;
use Spatie\EventSourcing\Projections\Projection;

interface GetCustomerInterface
{
    /**
     * Find a customer by serial or create new one
     *
     * @param string|null $customerSerial
     * @param string|null $customerName
     * @return Projection
     */
    public function execute(string|null $customerSerial, string|null $customerName): Projection;
}
