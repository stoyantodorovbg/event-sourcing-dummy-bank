<?php

namespace App\Actions;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Dto\CreateCredit as CreateCreditDto;
use App\Models\Credit;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Support\Str;

class CreateCredit implements CreateCreditInterface
{
    public function __construct(
        protected readonly BorrowerRepositoryInterface $borrowerRepository,
        protected readonly CreditRepositoryInterface $creditRepository,
    )
    {
    }

    public function execute(array $data): Credit
    {
        $creditData = new CreateCreditDto(
            borrower: $this->borrowerRepository->findByNameOrCreate($data['borrowerName']),
            amount: $data['amount'],
            term: $data['term'],
            code: Str::uuid(),
            deadline: now()->addMonths($data['term'])->endOfDay()->toDateTimeString(),
        );

        return $this->creditRepository->create($creditData);
    }
}
