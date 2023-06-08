<?php

namespace App\Http\Livewire;

use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreditsIndex extends Component
{
    public Collection|null $credits = null;

    protected readonly CreditRepositoryInterface $creditRepository;

    protected $listeners = [
        'loadCredits' => 'loadCredits',
        'showAlert' => 'showAlert',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->creditRepository = resolve(CreditRepositoryInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.credits-index');
    }

    public function mount(): void
    {
        $this->loadCredits();
    }

    public function loadCredits(): void
    {
        $this->credits = $this->creditRepository->all(['borrower']);
    }

    public function showAlert(string $sessionKey, string $message): void
    {
        session()->flash($sessionKey, $message);
    }
}
