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
}
