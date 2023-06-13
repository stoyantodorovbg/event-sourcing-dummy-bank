<?php

namespace App\Repositories\Interfaces;

use App\Projections\Borrower;

interface BorrowerRepositoryInterface
{
    /**
     * Find a borrower by name
     *
     * @param string $name
     * @return Borrower|null
     */
    public function findByName(string $name): Borrower|null;

    /**
     * Get the borrower's total due amount
     *
     * @param string $name
     * @return float
     */
    public function borrowerTotalDueAmount(string $name): float;
}
