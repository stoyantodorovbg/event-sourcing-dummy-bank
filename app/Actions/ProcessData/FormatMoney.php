<?php

namespace App\Actions\ProcessData;

use App\Actions\Interfaces\FormatMoneyInterface;

class FormatMoney implements FormatMoneyInterface
{
    public function execute(float|null $money): string
    {
        if (! $money) {
            return '0.00';
        }

        return number_format($money, 2, '.', ',');
    }
}
