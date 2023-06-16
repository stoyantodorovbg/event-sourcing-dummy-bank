<?php

namespace App\Repositories;

use App\Projections\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    protected string $model = Customer::class;

    public function findByName(string $name): Customer|null
    {
        return $this->model::where(compact('name'))->first();
    }

    public function customerTotalDueAmount(string $name): float
    {
        return (float) $this->model::where('name', $name)
            ->first()
            ?->credits()
            ->sum(DB::raw('amount - deposit'));
    }
}
