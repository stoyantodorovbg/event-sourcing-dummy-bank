<?php

namespace App\Http\Livewire\Traits;

trait UnsetAttributes
{
    protected function unsetAttributes(): void
    {
        foreach ($this->attributesToUnset as $attribute)
        {
            $this->attribute = null;
        }
    }
}
