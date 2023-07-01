<?php

namespace App\Actions\CreateProjection;

use App\Actions\CreateProjection\Traits\GetCustomerSerial;
use App\Actions\Interfaces\CreateCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\Customer\CreateCustomerInput;
use App\Events\NewCustomer;
use App\Projections\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;
use App\Dto\Customer\CreateCustomer as CreateCustomerDto;

readonly class CreateCustomer implements CreateCustomerInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected GetSerialNumberInterface    $getSerialNumber,
    )
    {
    }

    public function execute(CreateCustomerInput $data): Projection
    {
        $serial = $this->getSerialNumber->execute(Customer::class);
        $customerData = new CreateCustomerDto(
            uuid: Str::uuid(),
            name: $data->customerName,
            serial: $serial,
            createdAt: now(),
        );

        NewCustomer::dispatch($customerData);

        return $this->customerRepository->findBySerial($serial);
    }
}
