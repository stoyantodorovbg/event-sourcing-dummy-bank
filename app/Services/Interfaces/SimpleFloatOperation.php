<?php

namespace App\Services\Interfaces;

interface SimpleFloatOperation
{
    /**
     * Calculate a value by given inputs
     *
     * @param float $input1
     * @param float $input2
     * @return float
     */
    public function execute(float $input1, float $input2): float;
}
