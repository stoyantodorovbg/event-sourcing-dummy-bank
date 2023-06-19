<?php

namespace App\Actions;

use App\Actions\Interfaces\GetDepositAmountInterface;
use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Actions\Interfaces\CreateDepositInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\CreateDepositInput;
use App\Dto\CreateDeposit as CreateDepositDto;
use App\Dto\UpdateDepositable;
use App\Events\NewDeposit;

readonly class CreateDeposit implements CreateDepositInterface
{
    public function __construct(
        protected GetDepositAmountInterface    $getDepositAmount,
        protected GetDepositRemainderInterface $getDepositRemainder,
        protected GetSerialNumberInterface     $getSerialNumber,
    )
    {
    }

    public function execute(CreateDepositInput $data): float
    {
        $depositableName = explode('\\', $data->depositableType);
        $depositableName = end($depositableName);
        $depositable = resolve("App\\Repositories\\Interfaces\\{$depositableName}RepositoryInterface")->findBySerial($data->depositableSerial);

        $remainder = $this->getDepositRemainder->execute($depositable, $data->amount);
        $depositAmount = $this->getDepositAmount->execute($data->amount, $remainder);

        $event = "\\App\\Events\\Update{$depositableName}Deposit";
        $event::dispatch(new UpdateDepositable(
            depositableUuid: $depositable->uuid,
            amount: $depositAmount,
        ));

        NewDeposit::dispatch(new CreateDepositDto(
                depositableSerial: $data->depositableSerial,
                depositableType: $data->depositableType,
                amount: $depositAmount,
                serial: $this->getSerialNumber->execute($data->depositableType),
                createdAt: now(),
            )
        );

        return $remainder;
    }
}
