<?php

namespace App\Actions\CreateProjection;

use App\Actions\CreateProjection\Helpers\GetCustomerSerial;
use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\AggregateRoots\CreditAggregateRoot;
use App\Dto\Credit\CreateCredit as CreateCreditDto;
use App\Dto\Credit\CreateCreditInput;
use App\Projections\Credit;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

readonly class CreateCredit implements CreateCreditInterface
{
    use GetCustomerSerial;

    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected CreditRepositoryInterface   $creditRepository,
        protected GetCustomerInterface        $getCustomer,
        protected GetSerialNumberInterface    $getSerialNumber,
    )
    {
    }

    public function execute(CreateCreditInput $data): Projection
    {
        $creditDto = new CreateCreditDto(
            uuid: Str::uuid(),
            customerSerial: $this->getCustomerSerial($data->customerSerial, $data->customerName),
            amount: $data->amount,
            term: $data->term,
            serial: $this->getSerialNumber->execute(Credit::class),
            deadline: now()->addMonths($data->term)->endOfDay(),
            createdAt: now(),
        );

        CreditAggregateRoot::retrieve($creditDto->uuid)->newCredit($creditDto)->persist();

        return $this->creditRepository->findBySerial($creditDto->serial);
    }
}
