<?php

namespace App\Actions;

use App\Actions\Interfaces\CreateAccountInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\CreateAccount as CreateAccountDto;
use App\Dto\CreateAccountInput;
use App\Events\NewAccount;
use App\Projections\Account;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

readonly class CreateAccount implements CreateAccountInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected AccountRepositoryInterface   $accountRepository,
        protected GetCustomerInterface        $getCustomer,
        protected GetSerialNumberInterface    $getSerialNumber,
    )
    {
    }

    public function execute(CreateAccountInput $data): Projection
    {
        $serial = $this->getSerialNumber->execute(Account::class);
        $accountData = new CreateAccountDto(
            uuid: Str::uuid(),
            customerSerial: $this->getCustomer->execute($data->customerSerial, $data->customerName)->serial,
            amount: $data->amount,
            serial: $serial,
            createdAt: now(),
        );

        NewAccount::class::dispatch($accountData);

        return $this->accountRepository->findBySerial($serial);
    }
}
