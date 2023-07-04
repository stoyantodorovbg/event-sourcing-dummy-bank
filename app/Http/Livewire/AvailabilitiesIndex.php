<?php

namespace App\Http\Livewire;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Repositories\Interfaces\AvailabilityRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class AvailabilitiesIndex extends Component
{
    public Collection $availabilities;

    protected readonly AvailabilityRepositoryInterface $availabilityRepository;
    protected readonly FormatMoneyInterface $formatMoney;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->availabilityRepository = resolve(AvailabilityRepositoryInterface::class);
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->availabilities = $this->availabilityRepository->all();

        return view('livewire.availabilities-index');
    }
}
