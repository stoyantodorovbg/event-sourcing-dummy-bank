<?php

namespace App\Projections;

use Spatie\EventSourcing\Projections\Projection;

class BaseProjection extends Projection
{
    public function getKeyName()
    {
        return 'id';
    }

    public function getKeyType()
    {
        return 'integer';
    }
}
