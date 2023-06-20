<?php

namespace Database\Factories\Projections;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Projections\Customer;
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
        $amount = fake()->randomFloat(2, 100, 10000);

        return [
            'uuid' => Str::uuid(),
            'customer_serial' => Customer::factory()->create()->serial,
            'initial_amount' => $amount,
            'amount' => $amount,
            'term' => $term,
            'remaining_installments' => $term,
            'serial' => resolve(GetSerialNumberInterface::class)->execute($this->model),
            'deadline' => now()->addMonths($term),
        ];
    }
}
