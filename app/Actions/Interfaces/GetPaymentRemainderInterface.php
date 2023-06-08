<?php

namespace App\Actions\Interfaces;

use App\Models\Credit;

interface GetPaymentRemainderInterface
{
    /**
     * Get the remainder from deposit
     *
     * @param Credit $credit
     * @param float  $deposit
     * @return float
     */
    public function execute(Credit $credit, float $deposit): float;
}
