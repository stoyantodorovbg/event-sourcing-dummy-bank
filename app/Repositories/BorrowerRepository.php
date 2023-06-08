<?php

namespace App\Repositories;

use App\Models\Borrower;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BorrowerRepository extends Repository implements BorrowerRepositoryInterface
{
    protected string $model = Borrower::class;

    public function findByNameOrCreate(string $name): Borrower
    {
        return $this->model::firstOrCreate(compact('name'));
    }

    public function borrowerTotalDueAmount(string $name): float
    {
        return (float) $this->model::where('name', $name)
            ->first()
            ?->credits()
            ->sum(DB::raw('amount - deposit'));
    }
}
