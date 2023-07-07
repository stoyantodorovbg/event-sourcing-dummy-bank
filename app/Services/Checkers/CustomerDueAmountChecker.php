<?php

namespace App\Services\Checkers;


use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Services\Interfaces\ValidatorInterface;

readonly class CustomerDueAmountChecker extends Checker
{
    public function __construct(
        protected ValidatorInterface $validateParameter,
        protected string $dto,
    )
    {
    }

    public function check(object $dto): bool|string
    {
        $this->validateDto($dto);

        $allowableAmount = config('app.customerMaxTotalAmount');

        if (! $dto->customerSerial && $dto->value < $allowableAmount) {
            return false;
        }

        $totalAmount = resolve(CustomerRepositoryInterface::class)->customerTotalDueAmount($dto->customerSerial) + $dto->value;
        if ($totalAmount > $allowableAmount) {
            $totalAmount = number_format($totalAmount, 2, '.', ',');
            $allowableAmount = number_format($allowableAmount, 2, '.', ',');

            return "The total amount owed to the customer will become {$totalAmount} BGN, but it shouldn't be greater then {$allowableAmount} BGN";
        }

        return false;
    }
}
