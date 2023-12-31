<?php

namespace App\Events;

use App\Dto\Deposit\CreateDeposit;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewDeposit extends ShouldBeStored
{
    use Dispatchable;

    public function __construct(public readonly CreateDeposit $attributes)
    {
    }
}
