<?php

namespace Infrastructure\Services;

use Domain\Interfaces\ValidatorInterface;

class ValidatorManager
{
    private array $validators;

    public function __construct(ValidatorInterface ...$validators)
    {
        $this->validators = $validators;
    }

    public function validate(array $data): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($data)) {
                return false;
            }
        }
        return true;
    }
}