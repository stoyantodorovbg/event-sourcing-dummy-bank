<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\CreateDepositInterface;
use App\Dto\Deposit\CreateDepositInput;
use App\Http\Livewire\Traits\CreateCustomer;
use App\Http\Livewire\Traits\UnsetAttributes;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateDeposit extends Component
{
    use UnsetAttributes, CreateCustomer;

    public Collection|null $depositableSerials = null;

    public string|null $depositableSerial;
    public float|string|null $deposit;

    public string|null $depositable = null;
    protected $listeners = [
        'loadDepositables' => 'loadDepositables',
    ];
    protected array $attributesToUnset = ['depositableSerial', 'deposit'];

    protected readonly RepositoryInterface $depositableRepository;
    protected readonly CreateDepositInterface $createDeposit;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->createDeposit = resolve(CreateDepositInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-deposit');
    }

    public function mount(string $depositable): void
    {
        $this->depositable = $depositable;
        $this->depositableRepository = resolve($this->getDepositableUtilityName('App\\Repositories\\Interfaces\\', 'RepositoryInterface'));
        $this->loadDepositables();
    }

    public function rules(): array
    {
        return [
            'depositableSerial' => strtolower($this->getDepositableUtilityName('required|string|exists:', 's,serial')),
            'deposit' => 'required|numeric|min:1',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $deposit = $this->createDeposit->execute(new CreateDepositInput(
            depositableSerial: $this->depositableSerial,
            depositableType: $this->getDepositableUtilityName('\\App\\Projections\\'),
            amount: $this->deposit,
        ));

        $this->emit($this->getDepositableUtilityName('load', 's'));
        $this->emit('loadCustomers');
        $this->unsetAttributes();
        $this->emit('showAlert', 'success.message', 'Deposit created.');
        if ($deposit->reminder) {
            $reminder = number_format($reminder, 2, '.', ',');
            $message = "Тhe deposit exceeds the allowed amount. Remainder of the deposit: {$reminder} BGN";
            $this->emit('showAlert', 'warning.message', $message);
        }
    }

    public function loadDepositables(): void
    {
        $this->depositableSerials = $this->depositableRepository->allQuery()->pluck('serial');
    }

    protected function getDepositableUtilityName(string $start = '', string $end = ''): string
    {
        return $start . $this->depositable . $end;
    }
}
