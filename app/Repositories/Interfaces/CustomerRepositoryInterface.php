<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
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
