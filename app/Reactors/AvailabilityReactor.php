<?php

namespace App\Reactors;

use App\Dto\Availability\UpdateAvailabilityInput;
use App\Enums\Operation;
use App\Enums\Projections\AvailabilityName;
use App\Events\NewAccount;
use App\Events\NewCredit;
use App\Events\NewDeposit;
use App\Events\UpdateAvailability;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class AvailabilityReactor extends Reactor
{
    public function onNewDeposit(NewDeposit $event): void
    {
        UpdateAvailability::dispatch($this->getData(Operation::SUM, $event->attributes->amount));
    }

    public function onNewAccount(NewAccount $event): void
    {
        UpdateAvailability::dispatch($this->getData(Operation::SUM, $event->attributes->amount));
    }

    public function onNewCredit(NewCredit $event): void
    {
        UpdateAvailability::dispatch($this->getData(Operation::SUBTRACT, $event->attributes->amount));
    }

    protected function getData(Operation $operation, float $amount): UpdateAvailabilityInput
    {
        return new UpdateAvailabilityInput(
            name: AvailabilityName::AVAILABLE,
            operation: $operation,
            amount: $amount
        );
    }
}
