<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Collection;

trait CreateCustomer
{
    public Collection|null $customersSerials = null;

    protected array $createCustomerValidation = [
        'customerName' => 'required_without:customerSerial',
        'customerSerial' => 'nullable|string|min:11|max:11',
    ];

    public function loadCustomers(): void
    {
        $this->customersSerials = $this->customerRepository->serials();
    }
}
