<?php

namespace App\Repositories\Interfaces;

use App\Dto\CreateCredit;
use App\Models\Credit;

interface CreditRepositoryInterface
{
    /**
     * Create a credit
     *
     * @param CreateCredit $data
     * @return Credit
     */
    public function create(CreateCredit $data): Credit;

    /**
     * Try to found a credit by code
     * Throw exception when such credit is missing
     *
     * @param string $code
     * @return Credit
     */
    public function findByCode(string $code): Credit;
}
