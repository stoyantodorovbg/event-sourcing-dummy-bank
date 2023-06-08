<?php

namespace App\Repositories\Interfaces;

use App\Models\Borrower;

interface BorrowerRepositoryInterface
{
    /**
     * Find a borrower by name or create a new borrower
     *
     * @param string $name
     * @return Borrower
     */
    public function findByNameOrCreate(string $name): Borrower;

    /**
     * Get the borrower's total due amount
     *
     * @param string $name
     * @return float
     */
    public function borrowerTotalDueAmount(string $name): float;
}
