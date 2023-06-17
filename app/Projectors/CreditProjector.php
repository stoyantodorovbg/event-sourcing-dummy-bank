<?php

namespace App\Projectors;

use App\Events\NewCredit;
use App\Events\UpdateCreditDeposit;
use App\Projections\Credit;
use Spatie\EventSourcing\Projections\Projection;

class CreditProjector extends BaseProjector
{
    protected string $projection = Credit::class;

    public function onNewCredit(NewCredit $event): Projection
    {
        return $this->project($event->attributes);
    }

    public function onUpdateCreditDeposit(UpdateCreditDeposit $event): Projection
    {
        $credit = $this->getWritable($event->attributes->depositable);
        $credit->deposit += $event->attributes->amount;
        $credit->save();

        return $credit;
    }
}
