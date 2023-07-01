<?php

namespace App\Events;

use App\Dto\Deposit\UpdateDepositable;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UpdateCreditDeposit extends ShouldBeStored
{
    use Dispatchable;

    public function __construct(public readonly UpdateDepositable $attributes)
    {
    }
}
