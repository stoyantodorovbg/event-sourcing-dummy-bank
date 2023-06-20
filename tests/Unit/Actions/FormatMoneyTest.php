<?php

namespace Unit\Actions;

use App\Actions\Interfaces\FormatMoneyInterface;
use Tests\TestCaseWithoutDb;

class FormatMoneyTest extends TestCaseWithoutDb
{
    /** @test */
    public function returns_0_when_receives_null(): void
    {
        $action = $this->getAction();
        $output = $action->execute(null);
        $this->assertSame('0.00', $output);
        $output = $action->execute(0);
        $this->assertSame('0.00', $output);
    }

    /** @test */
    public function returns_the_expected_format(): void
    {
        $action = $this->getAction();
        $output = $action->execute(1000000);
        $this->assertSame('1,000,000.00', $output);
        $output = $action->execute(1000000.1);
        $this->assertSame('1,000,000.10', $output);
        $output = $action->execute(1000000.872367234);
        $this->assertSame('1,000,000.87', $output);
    }

    protected function getAction(): FormatMoneyInterface
    {
        return resolve(FormatMoneyInterface::class);
    }
}
