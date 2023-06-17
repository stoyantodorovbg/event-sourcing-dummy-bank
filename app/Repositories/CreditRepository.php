<?php

namespace App\Repositories;

use App\Dto\CreateCredit;
use App\Projections\Credit;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Support\Collection;

class CreditRepository extends Repository implements CreditRepositoryInterface
{
    protected string $model = Credit::class;

    public function findByCode(string $serial): Credit
    {
        if ($credit = $this->model::where('serial', $serial)->first()) {
            return $credit;
        }

        throw new RecordsNotFoundException();
    }

    public function all(array $with = [], string $orderBy = 'created_at', string $order = 'desc'): Collection
    {
        return $this->allQuery($with, $orderBy, $order)->get();
    }

    public function allQuery(array $with = [], string $orderBy = 'created_at', string $order = 'desc'): Builder
    {
        return $this->model::with($with)->orderBy($orderBy, $order);
    }
}
