<?php

namespace App\Projectors;

use App\Events\NewDeposit;
use App\Projections\Deposit;
use Spatie\EventSourcing\Projections\Projection;

class DepositProjector extends BaseProjector
{
    protected string $projection = Deposit::class;

    public function onNewDeposit(NewDeposit $event): Projection
    {
        return $this->project($event->attributes);
    }
}
