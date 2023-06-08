<?php

namespace App\Actions\Interfaces;

use App\Dto\PayInstallment as PayInstallmentDto;

interface PayInstallmentInterface
{
    /**
     * Pay an installment
     *
     * @param PayInstallmentDto $data
     * @return float
     */
    public function execute(PayInstallmentDto $data): float;
}
