<?php

namespace App\Repositories;

use App\Models\Borrower;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;

class BorrowerRepository extends Repository implements BorrowerRepositoryInterface
{
    protected string $model = Borrower::class;

    public function findByNameOrCreate(string $name): Borrower
    {
        return $this->model::firstOrCreate(compact('name'));
    }
}
