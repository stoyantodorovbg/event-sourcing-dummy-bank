<?php

namespace App\Rules;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CustomerMaxDueAmount implements ValidationRule
{
    public function __construct(
        protected readonly CustomerRepositoryInterface $customerRepository,
    )
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $customer = request()->get('serverMemo')['data']['customer'];
        $totalAmount = $this->customerRepository->customerTotalDueAmount($customer) + $value;
        $allowableAmount = config('app.customerMaxTotalAmount');
        if ($totalAmount > $allowableAmount) {
            $totalAmount = number_format($totalAmount, 2, '.', ',');
            $allowableAmount = number_format($allowableAmount, 2, '.', ',');
            $fail("The total amount owed to the customer will become {$totalAmount} BGN, but it shouldn't be greater then {$allowableAmount} BGN");
        }
    }
}
