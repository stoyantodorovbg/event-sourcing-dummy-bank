<?php

namespace App\Actions\CreateProjection;

use App\Actions\CreateProjection\Helpers\GetCustomerSerial;
use App\Actions\Interfaces\CreateCreditInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\Credit\CreateCredit as CreateCreditDto;
use App\Dto\Credit\CreateCreditInput;
use App\Events\NewCredit;
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
        $serial = $this->getSerialNumber->execute(Credit::class);
        $creditData = new CreateCreditDto(
            uuid: Str::uuid(),
            customerSerial: $this->getCustomerSerial($data->customerSerial, $data->customerName),
            amount: $data->amount,
            term: $data->term,
            serial: $serial,
            deadline: now()->addMonths($data->term)->endOfDay(),
            createdAt: now(),
        );

        NewCredit::class::dispatch($creditData);

        return $this->creditRepository->findBySerial($serial);
    }
}
