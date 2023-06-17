<?php

namespace App\Actions;

use App\Actions\Interfaces\GetPaymentAmountInterface;
use App\Actions\Interfaces\GetPaymentRemainderInterface;
use App\Actions\Interfaces\PayInstallmentInterface;
use App\Dto\PayInstallment as PayInstallmentDto;
use App\Enums\Models\CreditStatus;
use App\Events\UpdateCreditDeposit;
use App\Repositories\Interfaces\CreditRepositoryInterface;

readonly class PayInstallment implements PayInstallmentInterface
{
    public function __construct(
        protected CreditRepositoryInterface $creditRepository,
        protected GetPaymentAmountInterface $getPaymentAmount,
        protected GetPaymentRemainderInterface $getPaymentRemainder,
    )
    {
    }

    public function execute(PayInstallmentDto $data): float
    {
        $credit = $this->creditRepository->findBySerial($data->creditSerial);
        $remainder = 0.0;
        if ($credit->status === CreditStatus::PENDING->value) {
            $deposit = $data->deposit;
            $remainder = $this->getPaymentRemainder->execute($credit, $data->deposit);
            $paymentAmount = $this->getPaymentAmount->execute($deposit, $remainder);
            UpdateCreditDeposit::dispatch($credit, $paymentAmount);
        }

        return $remainder;
    }
}
