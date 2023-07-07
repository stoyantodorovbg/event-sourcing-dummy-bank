<?php

namespace App\AggregateRoots;

use App\AggregateRoots\Interfaces\InteractWithDepositableInterface;
use App\Dto\Account\CreateAccount;
use App\Dto\Deposit\CreateDeposit;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewAccount;
use App\Events\NewDeposit;
use App\Events\UpdateAccountDeposit;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class AccountAggregateRoot extends AggregateRoot implements InteractWithDepositableInterface
{
    public function newAccount(CreateAccount $attributes): self
    {
        $this->recordThat(new NewAccount($attributes));

        return $this;
    }

    public function newDeposit(CreateDeposit $attributes): self
    {
        $this->recordThat(new NewDeposit($attributes));

        return $this;
    }

    public function updateDepositable(UpdateDepositable $attributes): self
    {
        $this->recordThat(new UpdateAccountDeposit($attributes));

        return $this;
    }
}
