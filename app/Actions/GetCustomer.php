<?php

namespace App\Actions;

use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\CreateCustomer;
use App\Events\NewCustomer;
use App\Projections\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

readonly class GetCustomer implements GetCustomerInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected GetSerialNumberInterface    $getSerialNumber,
    )
    {
    }

    public function execute(string|null $customerSerial, string|null $customerName): Projection
    {
         if (! $customerSerial || ! ($customer = $this->fetchCustomer($customerSerial))) {
             $customerSerial = $this->getSerialNumber->execute(Customer::class);
             NewCustomer::dispatch(new CreateCustomer(
                 uuid: Str::uuid(),
                 name: $customerName,
                 serial: $customerSerial,
                 createdAt: now(),
             ));
             $customer = $this->fetchCustomer($customerSerial);
         }

         return $customer;
    }

    protected function fetchCustomer(string $customerSerial): Projection|null
    {
        return $this->customerRepository->findBySerial($customerSerial);
    }
}
