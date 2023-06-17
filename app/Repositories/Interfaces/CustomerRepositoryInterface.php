<?php

namespace App\Repositories\Interfaces;

use App\Projections\Customer;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    /**
     * Find a customer by serial
     *
     * @param string $serial
     * @return Customer|null
     */
    public function findBySerial(string $serial): Customer|null;

    /**
     * Get the customer's total due amount
     *
     * @param string $serial
     * @return float
     */
    public function customerTotalDueAmount(string $serial): float;

    /**
     * Get customers serials
     *
     * @return Collection
     */
    public function serials(): Collection;
}
