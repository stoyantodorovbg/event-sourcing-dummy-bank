<?php

namespace App\Actions\Interfaces;

use App\Models\Credit;

interface CreateCreditInterface
{
    /**
     * Create a credit
     *
     * @param array $data
     * @return Credit
     */
    public function execute(array $data): Credit;
}
