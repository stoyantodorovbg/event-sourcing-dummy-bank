<?php

namespace App\Actions\Interfaces;

use App\Dto\CreateDepositInput;

interface CreateDepositInterface
{
    /**
     * Pay an installment
     *
     * @param CreateDepositInput $data
     * @return float
     */
    public function execute(CreateDepositInput $data): float;
}
