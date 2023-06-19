<?php

namespace Database\Seeders;

use App\Actions\Interfaces\CreateAccountInterface;
use App\Dto\Account\CreateAccountInput;

class AccountsTableSeeder extends BaseSeeder
{
    protected int $count = 15;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $action = resolve(CreateAccountInterface::class);

        $counter = 0;
        while($counter < $this->count) {
            $input = new CreateAccountInput(
                customerName: "{$this->faker->firstName()} {$this->faker->firstName()}",
                customerSerial: null,
                amount: $this->faker->randomFloat(max: 20000),
            );
            $action->execute($input);

            $counter++;
        }
    }
}
