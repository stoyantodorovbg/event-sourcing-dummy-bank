<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\CreateCreditInterface;
use App\Dto\CreateCreditInput;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class CreateCredit extends Component
{
    public string|null $borrower;
    public float|null $amount;
    public int|null $term;

    protected readonly CreateCreditInterface $createCredit;

    protected array $rules = [
        'borrower' => 'required|string|min:5|max:70',
        'amount' => 'required|numeric|min:1',
        'term' => 'required|integer|min:1|max:12',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->createCredit = resolve(CreateCreditInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-credit');
    }

    public function submit(): void
    {
        $this->validate();

        $input = new CreateCreditInput(
            borrowerName: $this->borrower,
            amount: $this->amount,
            term: $this->term,
        );
        $this->createCredit->execute($input);

        $this->emit('loadCredits');
        $this->unsetAttributes();
        $this->emit('showAlert', 'success.message', 'Credit created.');
    }

    protected function unsetAttributes(): void
    {
        $this->borrower = null;
        $this->amount = null;
        $this->term = null;
    }
}
