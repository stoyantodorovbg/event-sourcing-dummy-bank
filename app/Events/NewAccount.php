<?php

namespace App\Events;

use App\Dto\Account\CreateAccount;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewAccount extends ShouldBeStored
{
    use Dispatchable;

    public function __construct(readonly public CreateAccount $attributes)
    {
    }
}
