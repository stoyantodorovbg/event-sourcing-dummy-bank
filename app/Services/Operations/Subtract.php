<?php

namespace App\Services\Operations;

use App\Services\Interfaces\SimpleFloatOperation;

class Subtract implements SimpleFloatOperation
{
    public function execute(float $input1, float $input2): float
    {
        return round($input1 - $input2, 2);
    }
}
