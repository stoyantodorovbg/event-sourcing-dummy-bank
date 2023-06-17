<?php

namespace App\Repositories\Interfaces;

use App\Dto\CreateCredit;
use App\Projections\Credit;
use Illuminate\Support\Collection;

interface CreditRepositoryInterface
{
    /**
     * Try to found a credit by serial
     * Throw exception when such credit is missing
     *
     * @param string $serial
     * @return Credit
     */
    public function findByCode(string $serial): Credit;

    /**
     * @param array $with
     * @param string $orderBy
     * @param string $order
     * @return Collection
     */
    public function all(array $with = [], string $orderBy = 'id', string $order = 'desc'): Collection;
}
