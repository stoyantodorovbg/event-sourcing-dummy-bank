<?php

namespace App\Actions\Interfaces;

use App\Dto\CreateDeposit as CreateDepositDto;

interface CreateDepositInterface
{
    /**
     * Pay an installment
     *
     * @param CreateDepositDto $data
     * @return float
     */
    public function execute(CreateDepositDto $data): float;
}
