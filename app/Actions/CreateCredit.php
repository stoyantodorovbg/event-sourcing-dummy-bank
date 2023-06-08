<?php

namespace App\Actions;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Dto\CreateCredit as CreateCreditDto;
use App\Dto\CreateCreditInput;
use App\Models\Credit;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Support\Str;

readonly class CreateCredit implements CreateCreditInterface
{
    public function __construct(
        protected BorrowerRepositoryInterface $borrowerRepository,
        protected CreditRepositoryInterface   $creditRepository,
    )
    {
    }

    public function execute(CreateCreditInput $data): Credit
    {
        $creditData = new CreateCreditDto(
            borrower: $this->borrowerRepository->findByNameOrCreate($data->borrowerName),
            amount: $data->amount,
            term: $data->term,
            code: Str::uuid(),
            deadline: now()->addMonths($data->term)->endOfDay()->toDateTimeString(),
        );

        return $this->creditRepository->create($creditData);
    }
}
