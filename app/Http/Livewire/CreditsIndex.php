<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CreditsIndex extends Component
{
    use WithPagination;

    protected Collection|LengthAwarePaginator|null $credits = null;

    protected readonly CreditRepositoryInterface $creditRepository;
    protected readonly FormatMoneyInterface $formatMoney;


    protected string $paginationTheme = 'bootstrap';
    protected $listeners = [
        'loadCredits' => 'loadCredits',
        'showAlert' => 'showAlert',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->creditRepository = resolve(CreditRepositoryInterface::class);
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->loadCredits();

        return view('livewire.credits-index');
    }

    public function loadCredits(): void
    {
        $this->credits = $this->creditRepository->allQuery(['customer'])->paginate();
    }

    public function showAlert(string $sessionKey, string $message): void
    {
        session()->flash($sessionKey, $message);
    }
}
