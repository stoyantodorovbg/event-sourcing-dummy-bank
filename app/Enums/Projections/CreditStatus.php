<?php

namespace App\Enums\Projections;

enum CreditStatus: int
{
    case PENDING = 0;
    case PAID = 1;
}
