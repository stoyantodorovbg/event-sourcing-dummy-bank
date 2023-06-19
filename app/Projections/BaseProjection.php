<?php

namespace App\Projections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

class BaseProjection extends Projection
{
    public function resetState(): void
    {
        $this->projection::query()->delete();
    }

    protected static function boot():void
    {
        parent::boot();

        static::creating(function (Model $model) {
            $keyName = $model->getKeyName();
            if (empty($model->$keyName)) {
                $model->setAttribute($model->getKeyName(), Str::uuid());
            }
        });
    }
}
