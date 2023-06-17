<?php

namespace Database\Factories\Projections;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Projections\Customer;
use Database\Factories\BaseFactory;
use Illuminate\Support\Str;

class CustomerFactory extends BaseFactory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'name' => "{$this->faker->firstName()} {$this->faker->firstName()}",
            'serial' => resolve(GetSerialNumberInterface::class)->execute($this->model),
        ];
    }
}
