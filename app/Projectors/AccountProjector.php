<?php

namespace App\Projectors;

use App\Events\NewAccount;
use App\Events\UpdateAccountDeposit;
use App\Events\UpdateCreditDeposit;
use App\Projections\Account;
use Spatie\EventSourcing\Projections\Projection;

class AccountProjector extends BaseProjector
{
    protected string $projection = Account::class;

    public function onNewAccount(NewAccount $event): Projection
    {
        return $this->project($event->attributes);
    }

    public function onUpdateAccountDeposit(UpdateAccountDeposit $event)
    {
        $account = $this->getWritable($event->attributes->depositable);
        $account->amount += $event->attributes->amount;
        $account->save();

        return $account;
    }
}
