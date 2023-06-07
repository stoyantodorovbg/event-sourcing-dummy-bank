<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Credit extends Model
{
    public function borrower(): BelongsTo
    {
        return $this->belongsTo(Borrower::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }
}
