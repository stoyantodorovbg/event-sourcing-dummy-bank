<?php

namespace App\Projectors;

use App\Events\NewBorrower;
use App\Projections\Borrower;
use Spatie\EventSourcing\Projections\Projection;

class BorrowerProjector extends BaseProjector
{
    protected string $projection = Borrower::class;

    public function onNewBorrower(NewBorrower $event): Projection
    {
        return $this->project($event->attributes);
    }
}
