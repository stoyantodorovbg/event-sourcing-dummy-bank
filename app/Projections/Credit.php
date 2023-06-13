<?php

namespace App\Projections;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends BaseProjection
{
    protected $primaryKey = 'id';
    protected $appends = ['due_amount', 'monthly_installment'];

    public function borrower(): BelongsTo
    {
        return $this->belongsTo(Borrower::class);
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
