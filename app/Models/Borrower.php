<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrower extends Model
{
    protected $fillable = ['name'];

    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }
}
