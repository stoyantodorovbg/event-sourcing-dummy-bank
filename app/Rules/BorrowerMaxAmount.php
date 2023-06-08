<?php

namespace App\Rules;

use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BorrowerMaxAmount implements ValidationRule
{
    public function __construct(
        protected readonly BorrowerRepositoryInterface $borrowerRepository,
    )
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $borrower = request()->get('serverMemo')['data']['borrower'];
        $totalAmount = $this->borrowerRepository->borrowerTotalDueAmount($borrower) + $value;
        $allowableAmount = config('app.borrowerMaxTotalAmount');
        if ($totalAmount > $allowableAmount) {
            $totalAmount = number_format($totalAmount, 2, '.', ',');
            $allowableAmount = number_format($allowableAmount, 2, '.', ',');
            $fail("The total amount owed to the borrower will become {$totalAmount} BGN, but it shouldn't be greater then {$allowableAmount} BGN");
        }
    }
}
