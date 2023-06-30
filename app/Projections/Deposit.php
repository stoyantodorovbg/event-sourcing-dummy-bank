<?php

namespace App\Projections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Deposit extends BaseProjection
{
    use HasFactory;

    public function depositable(): MorphTo
    {
        return $this->morphTo(id: 'depositable_serial', ownerKey: 'serial');
    }
}
