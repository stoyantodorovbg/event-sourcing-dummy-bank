<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\EventSourcing\Projections\Projection;

abstract class Repository implements RepositoryInterface
{
    protected string $projection;

    public function findBySerial(string $serial): Projection|null
    {
        return $this->projection::where('serial', $serial)->first();
    }

    public function all(array $with = [], string $orderBy = 'created_at', string $order = 'desc'): Collection
    {
        return $this->allQuery($with, $orderBy, $order)->get();
    }

    public function allQuery(array $with = [], string $orderBy = 'created_at', string $order = 'desc'): Builder
    {
        return $this->projection::with($with)->orderBy($orderBy, $order);
    }
}
