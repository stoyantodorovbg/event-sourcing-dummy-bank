<?php

namespace App\Repositories;

use App\Projections\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    protected string $model = Customer::class;

    public function findBySerial(string $serial): Customer|null
    {
        return $this->model::where(compact('serial'))->first();
    }

    public function customerTotalDueAmount(string $serial): float
    {
        return (float) $this->model::where('serial', $serial)
            ->first()
            ?->credits()
            ->sum(DB::raw('amount - deposit'));
    }

    public function serials(): Collection
    {
        return $this->model::orderBy('created_at', 'desc')->pluck('serial');
    }
}
