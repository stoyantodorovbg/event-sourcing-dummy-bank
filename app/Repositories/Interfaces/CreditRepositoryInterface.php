<?php

namespace App\Repositories\Interfaces;

use App\Dto\CreateCredit;
use App\Models\Credit;
use Illuminate\Support\Collection;

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

    /**
     * Update deposit
     *
     * @param Credit $credit
     * @param float  $paymentAmount
     * @return Credit
     */
    public function updateDeposit(Credit $credit, float $paymentAmount): Credit;

    /**
     * @param array $with
     * @return Collection
     */
    public function all(array $with = []): Collection;
}
