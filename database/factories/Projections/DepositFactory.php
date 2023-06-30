<?php

namespace Database\Factories\Projections;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Projections\Account;
use App\Projections\Deposit;
use Database\Factories\BaseFactory;
use Illuminate\Support\Str;

class DepositFactory extends BaseFactory
{
    protected $model = Deposit::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'depositable_type' => Account::class,
            'depositable_serial' => Account::factory()->create()->serial,
            'serial' => resolve(GetSerialNumberInterface::class)->execute($this->model),
            'amount' => fake()->randomFloat(2, 100, 10000),
            'remainder' => 0,
            'created_at' => now(),
        ];
    }
}
