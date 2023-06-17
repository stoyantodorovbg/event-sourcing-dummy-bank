<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\CreateAccountInterface;
use App\Dto\CreateAccountInput;
use App\Http\Livewire\Traits\CreateCustomer;
use App\Http\Livewire\Traits\UnsetAttributes;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateAccount extends Component
{
    use UnsetAttributes, CreateCustomer;

    public string|null $customerName = null;
    public string|null $customerSerial = null;
    public float|string|null $amount;

    public Collection|null $customersSerials = null;

    protected readonly CreateAccountInterface $createAccount;
    protected readonly CustomerRepositoryInterface $customerRepository;

    protected $listeners = [
        'loadCustomers' => 'loadCustomers',
    ];
    protected array $attributesToUnset = ['customerName', 'customerSerial','amount'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->createAccount = resolve(CreateAccountInterface::class);
        $this->customerRepository = resolve(CustomerRepositoryInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-account');
    }

    public function mount(): void
    {
        $this->loadCustomers();
    }

    public function rules(): array
    {
        return [
            ...$this->createCustomerValidation,
            'amount' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $this->createAccount->execute(new CreateAccountInput(
            customerName: $this->customerName,
            customerSerial: $this->customerSerial,
            amount: $this->amount,
        ));
        $this->loadCustomers();
        $this->emit('loadAccounts');
        $this->unsetAttributes();
        $this->emit('showAlert', 'success.message', 'Account created.');
    }
}
