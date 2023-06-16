<?php

namespace App\Actions;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Dto\CreateCredit as CreateCreditDto;
use App\Dto\CreateCreditInput;
use App\Events\NewCredit;
use App\Projections\Credit;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Support\Str;

readonly class CreateCredit implements CreateCreditInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected CreditRepositoryInterface   $creditRepository,
        protected GetCustomerInterface        $getCustomer,
    )
    {
    }

    public function execute(CreateCreditInput $data): Credit
    {
        $code = Str::uuid();
        $creditData = new CreateCreditDto(
            uuid: Str::uuid(),
            customerUuid: $this->getCustomer->execute($data->customerName)->uuid,
            amount: $data->amount,
            term: $data->term,
            code: $code,
            deadline: now()->addMonths($data->term)->endOfDay(),
            createdAt: now(),
        );

        NewCredit::class::dispatch($creditData);

        return $this->creditRepository->findByCode($code);
    }
}
