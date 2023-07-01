<?php

namespace App\Services\Operations;

use App\Services\Interfaces\SimpleFloatOperation;

class Sum implements SimpleFloatOperation
{
    public function execute(float $input1, float $input2): float
    {
        return $input1 + $input2;
    }
}
