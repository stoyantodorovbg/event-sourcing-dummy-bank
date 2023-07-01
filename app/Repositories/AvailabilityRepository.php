<?php

namespace App\Repositories;

use App\Enums\Projections\AvailabilityName;
use App\Projections\Availability;
use App\Repositories\Interfaces\AvailabilityRepositoryInterface;

class AvailabilityRepository extends Repository implements AvailabilityRepositoryInterface
{
    protected string $projection = Availability::class;

    public function findByName(AvailabilityName $name): Availability
    {
        return $this->projection::where('name', $name)->first();
    }
}
