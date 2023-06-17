<?php

namespace App\Actions\Interfaces;

use App\Projections\Credit;

interface GetDepositAmountInterface
{
    /**
     * Get deposit amount
     *
     * @param float $deposit
     * @param float $remainder
     * @return float
     */
    public function execute(float $deposit, float $remainder): float;
}
