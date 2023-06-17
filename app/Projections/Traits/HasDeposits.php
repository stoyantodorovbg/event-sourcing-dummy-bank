<?php

namespace App\Projections\Traits;

use App\Projections\Deposit;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDeposits
{
    public function deposits(): MorphMany
    {
        return $this->morphMany(related: Deposit::class, name: 'depositable', id: 'serial', localKey: 'depositable_serial');
    }
}
