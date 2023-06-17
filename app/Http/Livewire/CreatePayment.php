<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\PayInstallmentInterface;
use App\Dto\PayInstallment;
use App\Http\Livewire\Traits\CreateCustomer;
use App\Http\Livewire\Traits\UnsetAttributes;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreatePayment extends Component
{
    use UnsetAttributes, CreateCustomer;

    public Collection|null $creditsSerials = null;

    public string|null $creditSerial;
    public float|string|null $deposit;

    protected array $rules = [
        'creditSerial' => 'required|string|exists:credits,serial',
        'deposit' => 'required|numeric|min:1',
    ];
    protected $listeners = [
        'loadCredits' => 'loadCredits',
    ];
    protected array $attributesToUnset = ['creditSerial', 'deposit'];

    protected readonly CreditRepositoryInterface $creditRepository;
    protected readonly PayInstallmentInterface $payInstallment;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->creditRepository = resolve(CreditRepositoryInterface::class);
        $this->payInstallment = resolve(PayInstallmentInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-payment');
    }

    public function mount(): void
    {
        $this->loadCredits();
    }

    public function submit(): void
    {
        $this->validate();

        $reminder = $this->payInstallment->execute(new PayInstallment(
            creditSerial: $this->creditSerial,
            deposit: $this->deposit,
        ));

        $this->emit('loadCredits');
        $this->emit('loadCustomers');
        $this->unsetAttributes();
        $this->emit('showAlert', 'success.message', 'Payment created.');
        if ($reminder) {
            $reminder = number_format($reminder, 2, '.', ',');
            $message = "Тhe payment exceeds the amount due. Remainder of the deposit: {$reminder} BGN";
            $this->emit('showAlert', 'warning.message', $message);
        }
    }

    public function loadCredits(): void
    {
        $this->creditsSerials = $this->creditRepository->allQuery()->pluck('serial');
    }
}
