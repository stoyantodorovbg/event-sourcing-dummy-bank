<?php

namespace Database\Factories\Projections;

use App\Projections\Borrower;
use App\Projections\Credit;
use Database\Factories\BaseFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CreditFactory extends BaseFactory
{
    protected $model = Credit::class;

    public function definition(): array
    {
        $term = random_int(1, 12);

        return [
            'uuid' => Str::uuid(),
            'borrower_uuid' => Borrower::factory()->create(),
            'amount' => fake()->randomFloat(2, 100, 10000),
            'term' => $term,
            'code' => Str::uuid(),
            'deadline' => now()->addMonths($term),
        ];
    }
}
