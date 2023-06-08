<?php

namespace App\Actions;

use App\Actions\Interfaces\GetPaymentAmountInterface;
use App\Actions\Interfaces\GetPaymentRemainderInterface;
use App\Actions\Interfaces\PayInstallmentInterface;
use App\Dto\PayInstallment as PayInstallmentDto;
use App\Enums\Models\CreditStatus;
use App\Repositories\Interfaces\CreditRepositoryInterface;

class PayInstallment implements PayInstallmentInterface
{
    public function __construct(
        protected readonly CreditRepositoryInterface $creditRepository,
        protected readonly GetPaymentAmountInterface $getPaymentAmount,
        protected readonly GetPaymentRemainderInterface $getPaymentRemainder,
    )
    {
    }

    public function execute(PayInstallmentDto $data): float
    {
        $credit = $this->creditRepository->findByCode($data->code);
        $remainder = 0.0;
        if ($credit->status === CreditStatus::PENDING->value) {
            $deposit = $data->deposit;
            $remainder = $this->getPaymentRemainder->execute($credit, $data->deposit);
            $paymentAmount = $this->getPaymentAmount->execute($deposit, $remainder);
            $this->creditRepository->updateDeposit($credit, $paymentAmount);
        }

        return $remainder;
    }
}
