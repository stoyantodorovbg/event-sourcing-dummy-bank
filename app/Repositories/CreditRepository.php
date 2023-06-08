<?php

namespace App\Repositories;

use App\Dto\CreateCredit;
use App\Models\Credit;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Support\Collection;

class CreditRepository extends Repository implements CreditRepositoryInterface
{
    protected string $model = Credit::class;

    public function create(CreateCredit $data): Credit
    {
        return $this->model::forceCreate([
            'borrower_id' => $data->borrower->id,
            'amount' => $data->amount,
            'code' => $data->code,
            'term' => $data->term,
            'deadline' => $data->deadline,
        ]);
    }

    public function findByCode(string $code): Credit
    {
        if ($credit = $this->model::where('code', $code)->first()) {
            return $credit;
        }

        throw new RecordsNotFoundException();
    }

    public function updateDeposit(Credit $credit, float $paymentAmount): Credit
    {
        $credit->deposit += $paymentAmount;
        $credit->save();

        return $credit;
    }

    public function all(array $with = [], string $orderBy = 'id', string $order = 'desc'): Collection
    {
        return $this->model::with($with)->orderBy($orderBy, $order)->get();
    }
}
