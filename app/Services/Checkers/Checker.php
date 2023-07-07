<?php

namespace App\Services\Checkers;

use App\Services\Interfaces\CheckerInterface;
use App\Services\Interfaces\ValidatorInterface;

readonly abstract class Checker implements CheckerInterface
{
    protected ValidatorInterface $validateParameter;
    protected string $dto;

    protected function validateDto(object $dto): void
    {
        $this->validateParameter->validate($dto, 'object');
    }
}
