<?php

namespace App\Actions;

use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Projections\Credit;

class GetDepositRemainder implements GetDepositRemainderInterface
{
    public function execute(Credit $credit, float $deposit): float
    {
        if ($deposit <= $credit->due_amount) {
            return 0.0;
        }

        return $deposit - $credit->due_amount;
    }
}
