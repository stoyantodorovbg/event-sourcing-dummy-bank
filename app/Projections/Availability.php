<?php

namespace App\Projections;

use App\Enums\Projections\AvailabilityName;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends BaseProjection
{
    use HasFactory;

    protected $casts = [
        'name' => AvailabilityName::class
    ];
}
