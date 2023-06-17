<?php

namespace App\Projections\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasDeposits
{
    /**
     * @return MorphMany
     */
    public function deposits(): MorphMany;

    /**
     * @return float
     */
    public function getAllowableAmountAttribute(): float;
}
