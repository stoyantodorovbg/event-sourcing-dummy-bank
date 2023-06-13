<?php

namespace App\Projections;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrower extends BaseProjection
{
    protected $fillable = ['name'];

    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }
}
