<?php

namespace App\Services\Validators;

use App\Services\Interfaces\ValidatorInterface;

abstract class Validator implements ValidatorInterface
{
    protected mixed $input;
    protected string $inputType;

    public function __construct(
        readonly protected string $class,
        readonly protected string|null $expected = null,
    )
    {
    }

    public function validate(mixed $input, string $inputType): void
    {
        $this->input = $input;
        $this->inputType = $inputType;

        $this->$inputType($input);
    }

    /**
     * @return never
     */
    abstract protected function throwException(): never;

    /**
     * @return string
     */
    abstract protected function getMessage(): string;

    protected function object(object $parameter): void
    {
        if (! $parameter instanceof $this->expected) {
            $this->throwException();
        }
    }
}
