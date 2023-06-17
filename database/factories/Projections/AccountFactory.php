<?php

namespace Database\Factories\Projections;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Projections\Customer;
use App\Projections\Account;
use Database\Factories\BaseFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class AccountFactory extends BaseFactory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'customer_serial' => Customer::factory()->create()->serial,
            'amount' => fake()->randomFloat(2, 100, 10000),
            'serial' => resolve(GetSerialNumberInterface::class)->execute($this->model),
        ];
    }
}
