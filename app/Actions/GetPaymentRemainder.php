<?php

namespace App\Actions;

use App\Actions\Interfaces\GetPaymentRemainderInterface;
use App\Models\Credit;

class GetPaymentRemainder implements GetPaymentRemainderInterface
{
    public function execute(Credit $credit, float $deposit): float
    {
        if ($deposit <= $credit->due_amount) {
            return 0.0;
        }

        return $deposit - $credit->due_amount;
    }
}
