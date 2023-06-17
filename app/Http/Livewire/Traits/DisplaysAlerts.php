<?php

namespace App\Http\Livewire\Traits;

trait DisplaysAlerts
{
    public function showAlert(string $sessionKey, string $message): void
    {
        session()->flash($sessionKey, $message);
    }
}
