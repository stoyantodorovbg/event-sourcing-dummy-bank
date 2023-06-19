<?php

namespace App\Actions\ProcessData;

use App\Actions\Interfaces\GetDepositRemainderInterface;
use Spatie\EventSourcing\Projections\Projection;

class GetDepositRemainder implements GetDepositRemainderInterface
{
    public function execute(Projection $depositable, float $deposit): float
    {
        if ($deposit <= $depositable->allowable_amount) {
            return 0.0;
        }

        return $deposit - $depositable->allowable_amount;
    }
}
