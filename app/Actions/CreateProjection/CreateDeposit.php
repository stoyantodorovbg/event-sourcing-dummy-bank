<?php

namespace App\Actions\CreateProjection;

use App\Actions\Interfaces\CreateDepositInterface;
use App\Actions\Interfaces\GetDepositRemainderInterface;
use App\Actions\Interfaces\GetSerialNumberInterface;
use App\Dto\Deposit\CreateDeposit as CreateDepositDto;
use App\Dto\Deposit\CreateDepositInput;
use App\Dto\Deposit\UpdateDepositable;
use App\Enums\Operation;
use App\Events\NewDeposit;
use App\Repositories\Interfaces\DepositRepositoryInterface;
use App\Services\Interfaces\SimpleFloatOperation;
use Illuminate\Support\Str;
use Spatie\EventSourcing\Projections\Projection;

class CreateDeposit implements CreateDepositInterface
{
    protected SimpleFloatOperation $subtract;
    public function __construct(
        protected GetDepositRemainderInterface $getDepositRemainder,
        protected GetSerialNumberInterface     $getSerialNumber,
        protected DepositRepositoryInterface   $depositRepository,
    )
    {
        $this->subtract = resolve(Operation::SUBTRACT->value);
    }

    public function execute(CreateDepositInput $data): Projection
    {
        $depositableName = $this->getDepositableName($data->depositableType);
        $depositable = resolve("App\\Repositories\\Interfaces\\{$depositableName}RepositoryInterface")->findBySerial($data->depositableSerial);

        $remainder = $this->getDepositRemainder->execute($depositable, $data->amount);
        $depositAmount = $this->subtract->execute($data->amount, $remainder);

        $depositDto = new CreateDepositDto(
            uuid: Str::uuid(),
            depositableSerial: $data->depositableSerial,
            depositableType: $data->depositableType,
            amount: $depositAmount,
            remainder: $remainder,
            serial: $this->getSerialNumber->execute("\\App\\Projections\\{$depositableName}"),
            createdAt: now(),
        );
        $updateDepositableDto = new UpdateDepositable(
            depositableUuid: $depositable->uuid,
            amount: $depositAmount,
        );

        $aggregateRootClass = "\\App\\AggregateRoots\\{$depositableName}AggregateRoot";
        $aggregateRoot = $aggregateRootClass::retrieve($depositable->uuid);
        $aggregateRoot->newDeposit($depositDto)->updateDepositable($updateDepositableDto)->persist();

        return $this->depositRepository->findBySerial($depositDto->serial);
    }

    protected function getDepositableName(string $depositableType): string
    {
        $data = explode('\\', $depositableType);

        return $data[array_key_last($data)];
    }
}
