<?php

namespace App\Actions\Interfaces;

use App\Dto\Deposit\CreateDepositInput;
use Spatie\EventSourcing\Projections\Projection;

interface CreateDepositInterface
{
    /**
     * Pay an installment
     *
     * @param CreateDepositInput $data
     * @return Projection
     */
    public function execute(CreateDepositInput $data): Projection;
}
