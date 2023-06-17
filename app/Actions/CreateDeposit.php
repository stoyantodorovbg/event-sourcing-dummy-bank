<?php

namespace App\Actions;

use App\Actions\Interfaces\GetDepositAmountInterface;
use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Actions\Interfaces\CreateDepositInterface;
use App\Dto\CreateDeposit as CreateDepositDto;
use App\Enums\Models\CreditStatus;
use App\Events\UpdateCreditDeposit;
use App\Repositories\Interfaces\CreditRepositoryInterface;

readonly class CreateDeposit implements CreateDepositInterface
{
    public function __construct(
        protected CreditRepositoryInterface $creditRepository,
        protected GetDepositAmountInterface $getDepositAmount,
        protected GetDepositRemainderInterface $getDepositRemainder,
    )
    {
    }

    public function execute(CreateDepositDto $data): float
    {
        $credit = $this->creditRepository->findBySerial($data->creditSerial);
        $remainder = 0.0;
        if ($credit->status === CreditStatus::PENDING->value) {
            $deposit = $data->deposit;
            $remainder = $this->getDepositRemainder->execute($credit, $data->deposit);
            $depositAmount = $this->getDepositAmount->execute($deposit, $remainder);
            UpdateCreditDeposit::dispatch($credit, $depositAmount);
        }

        return $remainder;
    }
}
