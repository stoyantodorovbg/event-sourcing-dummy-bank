<?php

namespace App\Projectors\Traits;

trait ResetState
{
    public function resetState(): void
    {
        $this->projection::query()->delete();
    }
}
