<?php

namespace App\Actions\Interfaces;

use App\Dto\Customer\CreateCustomerInput;
use Spatie\EventSourcing\Projections\Projection;

interface CreateCustomerInterface
{
    /**
     * Find a customer by serial or create new one
     *
     * @param CreateCustomerInput $data
     * @return Projection
     */
    public function execute(CreateCustomerInput $data): Projection;
}
