<?php

namespace App\Projectors;

use App\Events\NewDeposit;
use App\Projections\Deposit;
use App\Projectors\Traits\ResetState;
use Spatie\EventSourcing\Projections\Projection;

class DepositProjector extends BaseProjector
{
    use ResetState;

    protected string $projection = Deposit::class;

    public function onNewDeposit(NewDeposit $event): Projection
    {
        return $this->project($event->attributes);
    }
}
