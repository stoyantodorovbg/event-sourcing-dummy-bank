<?php

namespace Tests\Unit\Projections;

use Tests\TestCase;

class BaseProjectorTest extends TestCase
{
    protected string $projector = '';

    protected function getProjector()
    {
        return new $this->projector;
    }
}
