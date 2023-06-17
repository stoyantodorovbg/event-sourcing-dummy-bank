<?php

namespace App\Repositories;

use App\Projections\Account;
use App\Repositories\Interfaces\AccountRepositoryInterface;

class AccountRepository extends Repository implements AccountRepositoryInterface
{
    protected string $projection = Account::class;
}
