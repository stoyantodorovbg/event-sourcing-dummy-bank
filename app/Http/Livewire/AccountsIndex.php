<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Http\Livewire\Traits\DisplaysAlerts;
use App\Http\Livewire\Traits\HasPagination;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class AccountsIndex extends Component
{
    use WithPagination, DisplaysAlerts, HasPagination;

    protected Collection|LengthAwarePaginator|null $accounts = null;

    protected readonly AccountRepositoryInterface $accountRepository;
    protected readonly FormatMoneyInterface $formatMoney;

    protected $listeners = [
        'loadAccounts' => 'loadAccounts',
        'showAlert' => 'showAlert',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->accountRepository = resolve(AccountRepositoryInterface::class);
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->loadAccounts();

        return view('livewire.accounts-index');
    }

    public function loadAccounts(): void
    {
        $this->accounts = $this->accountRepository->allQuery(['customer'])->paginate();
    }
}
