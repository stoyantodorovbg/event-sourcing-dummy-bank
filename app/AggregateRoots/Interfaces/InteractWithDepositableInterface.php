<?php

namespace App\AggregateRoots\Interfaces;

use App\Dto\Deposit\CreateDeposit;
use App\Dto\Deposit\UpdateDepositable;

interface InteractWithDepositableInterface
{
    public function newDeposit(CreateDeposit $attributes): self;

    public function updateDepositable(UpdateDepositable $attributes): self;
}
