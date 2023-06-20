<?php

namespace Unit\Actions;

use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Projections\Account;
use Tests\TestCase;

class GetSerialNumberTest extends TestCase
{
    /** @test */
    public function returns_a_string_in_expected_format(): void
    {
        $output = resolve(GetSerialNumberInterface::class)->execute(Account::class);
        $this->assertGreaterThan(10000000000, (int) $output);
        $this->assertLessThan(99999999999, (int) $output);
    }
}
