<?php

namespace App\Services\Validators;

use App\Exceptions\InvalidParameterException;

class ValidateParameter extends Validator
{
    /**
     * @return never
     * @throws InvalidParameterException
     */
    protected function throwException(): never
    {
        throw new InvalidParameterException($this->getMessage());
    }

    protected function getMessage(): string
    {
        $parameterClass = get_class($this->input);

        return "A method in {$this->class} expects a parameter of type {$this->inputType} {$this->expected}, but received {$parameterClass}";
    }
}
