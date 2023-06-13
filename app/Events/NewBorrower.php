<?php

namespace App\Events;

use App\Dto\CreateBorrower;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewBorrower extends ShouldBeStored
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public CreateBorrower $attributes)
    {
        //
    }
}
