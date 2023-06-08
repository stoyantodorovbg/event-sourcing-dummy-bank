<?php

namespace App\Actions;

use App\Actions\Interfaces\GetPaymentAmountInterface;

class GetPaymentAmount implements GetPaymentAmountInterface
{
    public function execute(float $deposit, float $remainder): float
    {
        return $deposit - $remainder;
    }
}
