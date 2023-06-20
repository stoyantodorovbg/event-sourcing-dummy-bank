<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCaseWithoutDb extends BaseTestCase
{
    use CreatesApplication;
}
