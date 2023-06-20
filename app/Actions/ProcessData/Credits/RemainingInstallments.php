<?php

namespace App\Actions\ProcessData\Credits;

use App\Actions\Interfaces\RemainingInstallmentsInterface;
use App\Projections\Credit;

class RemainingInstallments implements RemainingInstallmentsInterface
{
    public function execute(Credit $credit): int
    {
        return (int) ceil($credit->amount / $credit->initial_monthly_installment);
    }
}
