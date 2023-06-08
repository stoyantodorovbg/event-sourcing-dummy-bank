<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\PayInstallmentInterface;
use App\Dto\PayInstallment;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreatePayment extends Component
{
    public Collection|null $credits = null;

    public string|null $creditCode;
    public float|null $deposit;

    protected array $rules = [
        'creditCode' => 'required|string|exists:credits,code',
        'deposit' => 'required|numeric|min:1',
    ];

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
        $this->credits = $this->creditRepository->allQuery()->pluck('code');
    }

    public function submit(): void
    {
        $this->validate();

        $paymentInput = new PayInstallment(
            creditCode: $this->creditCode,
            deposit: $this->deposit,
        );
        $this->payInstallment->execute($paymentInput);

        $this->emit('loadCredits');
        $this->unsetAttributes();
        $this->emit('showAlert', 'success.message', 'Payment created.');
    }

    protected function unsetAttributes(): void
    {
        $this->creditCode = null;
        $this->deposit = null;
    }
}
