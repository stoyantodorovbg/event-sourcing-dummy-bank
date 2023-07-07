<?php

namespace App\Rules;

use App\Dto\Checkers\CheckCustomerDueAmount;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Services\Interfaces\CheckerInterface;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

readonly class CustomerMaxDueAmount implements ValidationRule
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected CheckerInterface $checker,
    )
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dto = new CheckCustomerDueAmount(
            customerSerial: request()->get('serverMemo')['data']['customerSerial'],
            value: $value,
        );

        if ($check = $this->checker->check($dto)) {
            $fail($check);
        }
    }
}
