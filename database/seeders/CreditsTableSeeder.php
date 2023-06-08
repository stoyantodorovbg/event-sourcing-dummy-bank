<?php

namespace Database\Seeders;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Dto\CreateCreditInput;

class CreditsTableSeeder extends BaseSeeder
{
    protected int $count = 15;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $action = resolve(CreateCreditInterface::class);

        $counter = 0;
        while($counter < $this->count) {
            $input = new CreateCreditInput(
                borrowerName: "{$this->faker->firstName()} {$this->faker->firstName()}",
                amount: $this->faker->randomFloat(max: 20000),
                term: rand(1, 12),
            );
            $action->execute($input);

            $counter++;
        }
    }
}
