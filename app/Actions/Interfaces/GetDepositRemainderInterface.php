<?php

namespace App\Actions\Interfaces;

use Spatie\EventSourcing\Projections\Projection;

interface GetDepositRemainderInterface
{
    /**
     * Get the remainder from deposit
     *
     * @param Projection $credit
     * @param float  $deposit
     * @return float
     */
    public function execute(Projection $credit, float $deposit): float;
}
