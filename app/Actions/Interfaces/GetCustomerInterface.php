<?php

namespace App\Actions\Interfaces;

use App\Dto\Customer\GetCustomer as GetCustomerDto;
use Spatie\EventSourcing\Projections\Projection;

interface GetCustomerInterface
{
    /**
     * @param GetCustomerDto $data
     * @return Projection
     */
    public function execute(GetCustomerDto $data): Projection;
}
