<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installment extends Model
{
    public function credit(): BelongsTo
    {
        return $this->belongsTo(Credit::class);
    }
}
