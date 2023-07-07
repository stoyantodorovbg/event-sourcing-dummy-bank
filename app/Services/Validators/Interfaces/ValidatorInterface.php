<?php

namespace App\Services\Validators\Interfaces;

interface ValidatorInterface
{
    public function validate(mixed $input, string $inputType): void;


}
