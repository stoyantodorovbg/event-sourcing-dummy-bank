<?php

namespace App\Projections;

use App\Enums\Projections\AvailabilityNames;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends BaseProjection
{
    use HasFactory;

    protected $casts = [
        'name' => AvailabilityNames::class
    ];
}
