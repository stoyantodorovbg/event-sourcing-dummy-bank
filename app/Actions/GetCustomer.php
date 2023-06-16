<?php

namespace App\Actions;

use App\Actions\Interfaces\GetCustomerInterface;
use App\Dto\CreateCustomer;
use App\Events\NewCustomer;
use App\Projections\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Str;

readonly class GetCustomer implements GetCustomerInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
    )
    {
    }

    public function execute(string $customerName): Customer
    {
         if (! $customer = $this->fetchCustomer($customerName)) {
             NewCustomer::dispatch(new CreateCustomer(
                 uuid: Str::uuid(),
                 name: $customerName,
                 createdAt: now(),
             ));
             $customer = $this->fetchCustomer($customerName);
         }

         return $customer;
    }

    protected function fetchCustomer($customerName): Customer|null
    {
        return $this->customerRepository->findByName($customerName);
    }
}
