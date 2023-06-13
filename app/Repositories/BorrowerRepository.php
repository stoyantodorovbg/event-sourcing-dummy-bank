<?php

namespace App\Repositories;

use App\Projections\Borrower;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BorrowerRepository extends Repository implements BorrowerRepositoryInterface
{
    protected string $model = Borrower::class;

    public function findByName(string $name): Borrower|null
    {
        return $this->model::where(compact('name'))->first();
    }

    public function borrowerTotalDueAmount(string $name): float
    {
        return (float) $this->model::where('name', $name)
            ->first()
            ?->credits()
            ->sum(DB::raw('amount - deposit'));
    }
}
