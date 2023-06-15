<?php

namespace App\Projections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrower extends BaseProjection
{
    use HasFactory;

    protected $fillable = ['name'];

    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }
}
