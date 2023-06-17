<?php

namespace App\Projectors;

use App\Events\NewAccount;
use App\Projections\Account;
use Spatie\EventSourcing\Projections\Projection;

class AccountProjector extends BaseProjector
{
    protected string $projection = Account::class;

    public function onNewAccount(NewAccount $event): Projection
    {
        return $this->project($event->attributes);
    }
}
