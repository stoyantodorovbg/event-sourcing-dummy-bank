<?php

namespace App\Dto\Period;

use Illuminate\Support\Carbon;

readonly class Period
{
    public function __construct(
        public Carbon $start,
        public Carbon $end
    )
    {
    }
}
