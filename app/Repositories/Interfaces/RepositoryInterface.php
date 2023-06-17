<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\EventSourcing\Projections\Projection;

interface RepositoryInterface
{
    /**
     * Find a projection by serial number
     *
     * @param string $serial
     * @return Projection|null
     */
    public function findBySerial(string $serial): Projection|null;

    /**
     * Fetch all
     *
     * @param array $with
     * @param string $orderBy
     * @param string $order
     * @return Collection
     */
    public function all(array $with = [], string $orderBy = 'id', string $order = 'desc'): Collection;

    /**
     * Query all
     *
     * @param array  $with
     * @param string $orderBy
     * @param string $order
     * @return Builder
     */
    public function allQuery(array $with = [], string $orderBy = 'created_at', string $order = 'desc'): Builder;
}
