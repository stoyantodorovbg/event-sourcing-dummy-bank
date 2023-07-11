<?php

namespace App\AggregateRoots;

use App\AggregateRoots\Interfaces\InteractWithDepositableInterface;
use App\Dto\Checkers\CheckCustomerDueAmount;
use App\Dto\Credit\CreateCredit;
use App\Dto\Deposit\CreateDeposit;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewCredit;
use App\Events\NewDeposit;
use App\Events\UpdateCreditDeposit;
use Illuminate\Validation\ValidationException;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CreditAggregateRoot extends AggregateRoot implements InteractWithDepositableInterface
{
    /**
     * @throws ValidationException
     */
    public function newCredit(CreateCredit $attributes): self
    {
        $dto = new CheckCustomerDueAmount(
            customerSerial: $attributes->customerSerial,
            value: $attributes->amount,
        );
        if ($check = resolve('customer-due-amount-checker')->check($dto)) {
            throw ValidationException::withMessages(['field_name' => $check]);
        }

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
