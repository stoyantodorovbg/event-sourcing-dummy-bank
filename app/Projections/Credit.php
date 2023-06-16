<?php

namespace App\Projections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends BaseProjection
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $appends = ['due_amount', 'monthly_installment'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getDueAmountAttribute(): float
    {
        return $this->amount - $this->deposit;
    }

    public function getMonthlyInstallmentAttribute(): float
    {
        return $this->amount / $this->term;
    }
}
