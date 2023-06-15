<?php

namespace Database\Factories\Projections;

use App\Projections\Borrower;
use Database\Factories\BaseFactory;
use Illuminate\Support\Str;

class BorrowerFactory extends BaseFactory
{
    protected $model = Borrower::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'name' => "{$this->faker->firstName()} {$this->faker->firstName()}"
        ];
    }
}
