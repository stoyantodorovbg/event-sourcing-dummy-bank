<?php

namespace App\Actions\Interfaces;

use Spatie\EventSourcing\Projections\Projection;

interface GetDepositRemainderInterface
{
    /**
     * @param Projection $depositable
     * @param float      $deposit
     * @return float
     */
    public function execute(Projection $depositable, float $deposit): float;
}
