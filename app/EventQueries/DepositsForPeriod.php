<?php

namespace App\EventQueries;

use App\Dto\Period\Period;
use App\Events\NewDeposit;
use Illuminate\Database\Eloquent\Builder;
use Spatie\EventSourcing\EventHandlers\Projectors\EventQuery;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

class DepositsForPeriod extends EventQuery
{
    protected float $totalAmount = 0.0;

    public function __construct(
        Period $period,
        string $type,
        string|null $depositableSerial = null,
    )
    {
        EloquentStoredEvent::query()
            ->whereEvent(NewDeposit::class)
            ->whereDate('event_properties->attributes->createdAt', '>=', $period->start)
            ->whereDate('event_properties->attributes->createdAt', '<=', $period->end)
            ->where('event_properties->attributes->depositableType', $type)
            ->when($depositableSerial, fn (Builder $query) =>
                $query->where('event_properties->attributes->depositableSerial', $depositableSerial)
            )
            ->cursor()
            ->each(
                fn (EloquentStoredEvent $event) => $this->apply($event->toStoredEvent())
            );
    }

    protected function applyNewDeposit(NewDeposit $newDeposit): void
    {
        $this->totalAmount += $newDeposit->attributes->amount - $newDeposit->attributes->remainder;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }
}
