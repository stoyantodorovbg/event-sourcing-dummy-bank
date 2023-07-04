<?php

namespace Unit\Services;

use App\Enums\Operation;
use App\Services\Operations\Subtract;
use App\Services\Operations\Sum;
use Tests\TestCaseWithoutDb;

class SimpleFloatOperationTest extends TestCaseWithoutDb
{
    /** @test */
    public function service_container_provides_the_right_instances(): void
    {
        $this->assertInstanceOf(Sum::class, resolve(Operation::SUM->value));
        $this->assertInstanceOf(Subtract::class, resolve(Operation::SUBTRACT->value));
    }

    /** @test */
    public function sum_operation_sums_two_floats(): void
    {
        $output = resolve(Operation::SUM->value)->execute(3.33, 2.22);
        $this->assertSame(5.55, $output);
    }

    /** @test */
    public function subtract_operation_subtracts_one_float_from_anothe(): void
    {
        $output = resolve(Operation::SUBTRACT->value)->execute(3.33, 2.22);
        $this->assertSame(1.11, $output);
    }
}
