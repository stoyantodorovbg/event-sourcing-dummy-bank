<?php

namespace App\AggregateRoots;

use App\AggregateRoots\Interfaces\InteractWithDepositableInterface;
use App\Dto\Credit\CreateCredit;
use App\Dto\Deposit\CreateDeposit;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewCredit;
use App\Events\NewDeposit;
use App\Events\UpdateCreditDeposit;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CreditAggregateRoot extends AggregateRoot implements InteractWithDepositableInterface
{
    public function newCredit(CreateCredit $attributes): self
    {
        $this->recordThat(new NewCredit($attributes));

        return $this;
    }

    public function newDeposit(CreateDeposit $attributes): self
    {
        $this->recordThat(new NewDeposit($attributes));

        return $this;
    }

    public function updateDepositable(UpdateDepositable $attributes): self
    {
        $this->recordThat(new UpdateCreditDeposit($attributes));

        return $this;
    }
}
