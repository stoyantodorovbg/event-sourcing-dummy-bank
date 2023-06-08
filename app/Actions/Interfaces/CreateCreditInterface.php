<?php

namespace App\Actions\Interfaces;

use App\Dto\CreateCreditInput;
use App\Models\Credit;

interface CreateCreditInterface
{
    /**
     * Create a credit
     *
     * @param CreateCreditInput $data
     * @return Credit
     */
    public function execute(CreateCreditInput $data): Credit;
}
