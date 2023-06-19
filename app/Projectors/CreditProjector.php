<?php

namespace App\Projectors;

use App\Events\NewCredit;
use App\Events\UpdateCreditDeposit;
use App\Projections\Credit;
use App\Projectors\Traits\ResetState;
use Spatie\EventSourcing\Projections\Projection;

class CreditProjector extends BaseProjector
{
    use ResetState;

    protected string $projection = Credit::class;

    public function onNewCredit(NewCredit $event): Projection
    {
        return $this->project($event->attributes);
    }

    public function onUpdateCreditDeposit(UpdateCreditDeposit $event): Projection
    {
        $credit = $this->findByUuid($event->attributes->depositableUuid)->writeable();
        $credit->deposit += $event->attributes->amount;
        $credit->amount -= $event->attributes->amount;
        $credit->save();

        return $credit;
    }
}
