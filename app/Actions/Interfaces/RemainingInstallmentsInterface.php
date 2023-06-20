<?php

namespace App\Actions\Interfaces;

use App\Projections\Credit;

interface RemainingInstallmentsInterface
{
    /**
     * Get remaining installments count
     *
     * @param Credit $credit
     * @return int
     */
    public function execute(Credit $credit): int;
}
