<?php

namespace App\Actions\Interfaces;

use App\Dto\Credit\CreateCreditInput;
use Spatie\EventSourcing\Projections\Projection;

interface CreateCreditInterface
{
    /**
     * Create a credit
     *
     * @param CreateCreditInput $data
     * @return Projection
     */
    public function execute(CreateCreditInput $data): Projection;
}
