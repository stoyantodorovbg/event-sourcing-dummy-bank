<?php

namespace App\Repositories;

use App\Dto\CreateCredit;
use App\Models\Credit;
use App\Repositories\Interfaces\CreditRepositoryInterface;
use Illuminate\Database\RecordsNotFoundException;

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
}
