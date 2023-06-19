<?php

namespace App\Repositories;

use App\Projections\Deposit;
use App\Repositories\Interfaces\DepositRepositoryInterface;

class DepositRepository extends Repository implements DepositRepositoryInterface
{
    protected string $projection = Deposit::class;

}
