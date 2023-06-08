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
    public float|string|null $amount;
    public int|string|null $term;

    protected readonly CreateCreditInterface $createCredit;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->createCredit = resolve(CreateCreditInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-credit');
    }

    public function rules(): array
    {
        return [
            'borrower' => 'required|string|min:5|max:70',
            'amount' => ['required', 'numeric', 'min:1', 'max:80000', resolve('borrower-max-amount')],
            'term' => 'required|integer|min:1|max:12',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $this->createCredit->execute(new CreateCreditInput(
            borrowerName: $this->borrower,
            amount: $this->amount,
            term: $this->term,
        ));

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
