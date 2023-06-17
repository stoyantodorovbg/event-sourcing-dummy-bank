<?php

namespace App\Repositories;

use App\Projections\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    protected string $projection = Customer::class;

    public function customerTotalDueAmount(string $serial): float
    {
        return (float) $this->projection::where('serial', $serial)
            ->first()
            ?->credits()
            ->sum(DB::raw('amount - deposit'));
    }

    public function serials(): Collection
    {
        return $this->projection::orderBy('created_at', 'desc')->pluck('serial');
    }
}
