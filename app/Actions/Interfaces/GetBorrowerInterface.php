<?php

namespace App\Actions\Interfaces;

use App\Projections\Borrower;

interface GetBorrowerInterface
{
    /**
     * Find a borrower by name or create new one
     *
     * @param string $borrowerName
     * @return Borrower
     */
    public function execute(string $borrowerName): Borrower;
}
