<?php

namespace App\Services\Interfaces;

interface ValidatorInterface
{
    /**
     * @param mixed  $input
     * @param string $inputType
     * @return void
     */
    public function validate(mixed $input, string $inputType): void;
}
