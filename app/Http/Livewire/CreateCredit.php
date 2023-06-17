<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Dto\CreateCreditInput;
use App\Http\Livewire\Traits\CreateCustomer;
use App\Http\Livewire\Traits\UnsetAttributes;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class CreateCredit extends Component
{
    use UnsetAttributes, CreateCustomer;

    public string|null $customerName = null;
    public string|null $customerSerial = null;
    public float|string|null $amount;
    public int|string|null $term;

    protected readonly CreateCreditInterface $createCredit;
    protected readonly CustomerRepositoryInterface $customerRepository;

    protected $listeners = [
        'loadCustomers' => 'loadCustomers',
    ];
    protected array $attributesToUnset = ['customerName', 'customerSerial','amount', 'term'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->createCredit = resolve(CreateCreditInterface::class);
        $this->customerRepository = resolve(CustomerRepositoryInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-credit');
    }

    public function mount(): void
    {
        $this->loadCustomers();
    }

    public function rules(): array
    {
        return [
            ...$this->createCustomerValidation,
            'amount' => ['required', 'numeric', 'min:1', 'max:80000', resolve('customer-max-due-amount')],
            'term' => 'required|integer|min:1|max:12',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $this->createCredit->execute(new CreateCreditInput(
            customerName: $this->customerName,
            customerSerial: $this->customerSerial,
            amount: $this->amount,
            term: $this->term,
        ));
        $this->loadCustomers();
        $this->emit('loadCredits');
        $this->unsetAttributes();
        $this->emit('showAlert', 'success.message', 'Credit created.');
    }
}
