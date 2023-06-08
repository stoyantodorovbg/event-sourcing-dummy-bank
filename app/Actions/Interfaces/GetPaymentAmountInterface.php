<?php

namespace App\Actions\Interfaces;

use App\Models\Credit;

interface GetPaymentAmountInterface
{
    /**
     * Get payment amount
     *
     * @param float $deposit
     * @param float $remainder
     * @return float
     */
    public function execute(float $deposit, float $remainder): float;
}
