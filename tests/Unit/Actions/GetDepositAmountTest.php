<?php

namespace Unit\Actions;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Actions\Interfaces\GetDepositAmountInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCaseWithoutDb;

class GetDepositAmountTest extends TestCaseWithoutDb
{
    use WithFaker;

    /** @test */
    public function returns_right_result(): void
    {
        $deposit = $this->faker->randomFloat();
        $remainder = $this->faker->randomFloat();
        $output = resolve(GetDepositAmountInterface::class)->execute($deposit, $remainder);
        $this->assertSame($deposit - $remainder, $output);
    }
}
