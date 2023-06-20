<?php

namespace App\Actions\ProcessData\Deposits;

use App\Actions\Interfaces\GetDepositAmountInterface;

class GetDepositAmount implements GetDepositAmountInterface
{
    public function execute(float $deposit, float $remainder): float
    {
        return $deposit - $remainder;
    }
}
