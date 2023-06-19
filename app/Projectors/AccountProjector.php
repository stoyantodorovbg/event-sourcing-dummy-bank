<?php

namespace App\Projectors;

use App\Events\NewAccount;
use App\Events\UpdateAccountDeposit;
use App\Events\UpdateCreditDeposit;
use App\Projections\Account;
use App\Projectors\Traits\ResetState;
use Spatie\EventSourcing\Projections\Projection;

class AccountProjector extends BaseProjector
{
    use ResetState;

    protected string $projection = Account::class;

    public function onNewAccount(NewAccount $event): Projection
    {
        return $this->project($event->attributes);
    }

    public function onUpdateAccountDeposit(UpdateAccountDeposit $event)
    {
        $account = $this->findByUuid($event->attributes->depositableUuid)->writeable();
        $account->amount += $event->attributes->amount;
        $account->save();

        return $account;
    }
}
