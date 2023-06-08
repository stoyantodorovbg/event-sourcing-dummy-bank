<?php

namespace Database\Seeders;

use App\Actions\Interfaces\CreateCreditInterface;

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
            $action->execute([
                'borrowerName' => "{$this->faker->firstName()} {$this->faker->firstName()}",
                'amount' => $this->faker->randomFloat(max: 20000),
                'term' => rand(1, 12),
            ]);

            $counter++;
        }
    }
}
