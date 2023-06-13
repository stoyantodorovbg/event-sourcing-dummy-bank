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

    public function findByCode(string $code): Credit
    {
        if ($credit = $this->model::where('code', $code)->first()) {
            return $credit;
        }

        throw new RecordsNotFoundException();
    }

    public function all(array $with = [], string $orderBy = 'id', string $order = 'desc'): Collection
    {
        return $this->allQuery($with, $orderBy, $order)->get();
    }

    public function allQuery(array $with = [], string $orderBy = 'id', string $order = 'desc'): Builder
    {
        return $this->model::with($with)->orderBy($orderBy, $order);
    }
}
