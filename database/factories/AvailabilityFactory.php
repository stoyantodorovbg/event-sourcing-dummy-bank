<?php

namespace Database\Factories;

use App\Projections\Availability;
use Illuminate\Support\Str;

class AvailabilityFactory extends BaseFactory
{
    protected $model = Availability::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'name' => 'Total Available Amount',
            'amount' => fake()->randomFloat(2, 100, 10000000),
        ];
    }
}
