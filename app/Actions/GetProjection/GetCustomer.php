<?php

namespace App\Actions\GetProjection;

use App\Actions\Interfaces\CreateCustomerInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Dto\Customer\CreateCustomerInput;
use App\Dto\Customer\GetCustomer as GetCustomerDto;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Spatie\EventSourcing\Projections\Projection;

readonly class GetCustomer implements GetCustomerInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected CreateCustomerInterface $createCustomer,
    )
    {
    }

    public function execute(GetCustomerDto $data): Projection
    {
        if ($data->customerSerial === null || ! ($customer = $this->customerRepository->findBySerial($data->customerSerial))) {
            return $this->createCustomer->execute(new CreateCustomerInput($data->customerName));
        }

        return $customer;
    }
}
