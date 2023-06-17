<?php

namespace App\Dto;

use App\Projections\Interfaces\HasDeposits;
use Spatie\EventSourcing\Projections\Projection;

readonly class UpdateDepositable
{
    public function __construct(
        public Projection|HasDeposits $depositable,
        public float $amount,
    )
    {
    }
}
