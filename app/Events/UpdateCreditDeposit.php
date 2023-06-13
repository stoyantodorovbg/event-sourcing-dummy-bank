<?php

namespace App\Events;

use App\Projections\Credit;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UpdateCreditDeposit extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public Credit $credit, public float $paymentAmount)
    {
        //
    }
}
