<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends Model
{
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
