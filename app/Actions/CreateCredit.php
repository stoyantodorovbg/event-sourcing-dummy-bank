<?php

namespace App\Actions;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\GetBorrowerInterface;
use App\Dto\CreateCredit as CreateCreditDto;
use App\Dto\CreateCreditInput;
use App\Events\NewCredit;
use App\Projections\Credit;
use App\Repositories\Interfaces\BorrowerRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Support\Str;

readonly class CreateCredit implements CreateCreditInterface
{
    public function __construct(
        protected BorrowerRepositoryInterface $borrowerRepository,
        protected CreditRepositoryInterface   $creditRepository,
        protected GetBorrowerInterface        $getBorrower,
    )
    {
    }

    public function execute(CreateCreditInput $data): Credit
    {
        $code = Str::uuid();
        $creditData = new CreateCreditDto(
            borrowerUuid: $this->getBorrower->execute($data->borrowerName)->uuid,
            amount: $data->amount,
            term: $data->term,
            code: $code,
            deadline: now()->addMonths($data->term)->endOfDay()->toDateTimeString(),
        );

        NewCredit::class::dispatch($creditData);

        return $this->creditRepository->findByCode($code);
    }
}
