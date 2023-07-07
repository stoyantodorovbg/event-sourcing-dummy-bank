<?php

namespace App\Services\Interfaces;

interface CheckerInterface
{
    public function check(object $dto): bool|string;
}
