<?php

namespace App\Projectors;

use App\Actions\Interfaces\RemainingInstallmentsInterface;
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
        $attributes = $event->attributes;
        $attributes->initialAmount = $attributes->amount;
        $attributes->remainingInstallments = $attributes->term;

        return $this->project($attributes);
    }

    public function onUpdateCreditDeposit(UpdateCreditDeposit $event): Projection
    {
        $credit = $this->findByUuid($event->attributes->depositableUuid)->writeable();
        $credit->deposit += $event->attributes->amount;
        $credit->amount -= $event->attributes->amount;
        $credit->remaining_installments = resolve(RemainingInstallmentsInterface::class)->execute($credit);
        $credit->save();

        return $credit;
    }
}
