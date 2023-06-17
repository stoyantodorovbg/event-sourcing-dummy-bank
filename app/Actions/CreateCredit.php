<?php

namespace App\Actions;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
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
        protected GetSerialNumberInterface    $getSerialNumber,
    )
    {
    }

    public function execute(CreateCreditInput $data): Credit
    {
        $serial = $this->getSerialNumber->execute(Credit::class);
        $creditData = new CreateCreditDto(
            uuid: Str::uuid(),
            customerSerial: $this->getCustomer->execute($data->customerSerial, $data->customerName)->serial,
            amount: $data->amount,
            term: $data->term,
            serial: $serial,
            deadline: now()->addMonths($data->term)->endOfDay(),
            createdAt: now(),
        );

        NewCredit::class::dispatch($creditData);

        return $this->creditRepository->findByCode($serial);
    }
}
