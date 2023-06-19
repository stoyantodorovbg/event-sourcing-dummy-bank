<?php

namespace App\Projections;

use App\Projections\Interfaces\HasDeposits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Projections\Traits\HasDeposits as HasDepositsTrait;

class Credit extends BaseProjection implements HasDeposits
{
    use HasFactory, HasDepositsTrait;

    protected $primaryKey = 'id';
    protected $appends = ['allowable_amount', 'monthly_installment'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_serial', 'serial');
    }

    public function getAllowableAmountAttribute(): float
    {
        return $this->amount;
    }

    public function getMonthlyInstallmentAttribute(): float
    {
        return $this->initial_amount / $this->term;
    }
}
