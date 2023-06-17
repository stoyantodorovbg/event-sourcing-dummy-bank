<?php

namespace App\Actions\Interfaces;

use App\Dto\CreateAccountInput;
use Spatie\EventSourcing\Projections\Projection;

interface CreateAccountInterface
{
    /**
     * Create an account
     *
     * @param CreateAccountInput $data
     * @return Projection
     */
    public function execute(CreateAccountInput $data): Projection;
}
