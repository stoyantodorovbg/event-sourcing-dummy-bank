<?php

namespace App\Actions\CreateProjection;

use App\Actions\CreateProjection\Helpers\GetCustomerSerial;
use App\Actions\Interfaces\CreateAccountInterface;
use App\Actions\Interfaces\GetCustomerInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\Account\CreateAccount as CreateAccountDto;
use App\Dto\Account\CreateAccountInput;
use App\Events\NewAccount;
use App\Projections\Account;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

readonly class CreateAccount implements CreateAccountInterface
{
    use GetCustomerSerial;

    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected AccountRepositoryInterface  $accountRepository,
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
            customerSerial: $this->getCustomerSerial($data->customerSerial, $data->customerName),
            amount: $data->amount,
            serial: $serial,
            createdAt: now(),
        );

        NewAccount::dispatch($accountData);

        return $this->accountRepository->findBySerial($serial);
    }
}
