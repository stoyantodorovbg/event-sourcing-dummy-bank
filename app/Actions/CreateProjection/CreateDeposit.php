<?php

namespace App\Actions\CreateProjection;

use App\Actions\Interfaces\CreateDepositInterface;
use App\Actions\Interfaces\CreateProjectionInterface;
use App\Actions\Interfaces\GetDepositAmountInterface;
use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\Deposit\CreateDeposit as CreateDepositDto;
use App\Dto\Deposit\CreateDepositInput;
use App\Dto\Deposit\UpdateDepositable;
use App\Events\NewDeposit;
use App\Projections\Credit;
use App\Repositories\Interfaces\DepositRepositoryInterface;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

readonly class CreateDeposit implements CreateDepositInterface
{
    public function __construct(
        protected GetDepositAmountInterface    $getDepositAmount,
        protected GetDepositRemainderInterface $getDepositRemainder,
        protected GetSerialNumberInterface     $getSerialNumber,
        protected DepositRepositoryInterface   $depositRepository,
    )
    {
    }

    public function execute(CreateDepositInput $data): Projection
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

        $serial = $this->getSerialNumber->execute(Credit::class);
        NewDeposit::dispatch(new CreateDepositDto(
                uuid: Str::uuid(),
                depositableSerial: $data->depositableSerial,
                depositableType: $data->depositableType,
                amount: $depositAmount,
                remainder: $remainder,
                serial: $serial,
                createdAt: now(),
            )
        );

        return $this->depositRepository->findBySerial($serial);
    }
}
