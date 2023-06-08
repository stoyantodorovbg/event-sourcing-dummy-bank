<?php

namespace App\Enums\Models;

enum CreditStatus: int
{
    case PENDING = 0;
    case PAID = 1;
}
