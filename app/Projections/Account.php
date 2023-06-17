<?php

namespace App\Projections;

use App\Projections\Interfaces\HasDeposits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Projections\Traits\HasDeposits as HasDepositsTrait;

class Account extends BaseProjection implements HasDeposits
{
    use HasFactory, HasDepositsTrait;

    protected $appends = ['allowable_amount'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_serial', 'serial');
    }

    public function getAllowableAmountAttribute(): float
    {
        return PHP_FLOAT_MAX;
    }
}
