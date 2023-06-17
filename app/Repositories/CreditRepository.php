<?php

namespace App\Repositories;

use App\Projections\Credit;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Database\RecordsNotFoundException;
use Spatie\EventSourcing\Projections\Projection;

class CreditRepository extends Repository implements CreditRepositoryInterface
{
    protected string $projection = Credit::class;

    public function findBySerial(string $serial): Projection
    {
        if ($projection = $this->projection::where('serial', $serial)->first()) {
            return $projection;
        }

        throw new RecordsNotFoundException();
    }
}
