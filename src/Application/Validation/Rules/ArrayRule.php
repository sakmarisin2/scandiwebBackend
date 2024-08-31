<?php

namespace Application\Validation\Rules;

use Domain\Interfaces\ValidationRule;

class ArrayRule implements ValidationRule {
    public function validate($value): bool{
        return is_array($value);
    }

    public function getErrorMessage(): string
    {
        return 'Value must be a valid array.';
    }
}
