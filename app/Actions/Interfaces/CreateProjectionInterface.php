<?php

namespace App\Actions\Interfaces;

use Spatie\EventSourcing\Projections\Projection;

interface CreateProjectionInterface
{
    public function execute(object $data): Projection;
}
