<?php

namespace Application\Validation\Rules;

use Application\Validation\Rules\ValidationRule;

class IntegerRule implements ValidationRule {
    public function validate($value): bool{
        return filter_var($value, FILTER_VALIDATE_INT) !== false 
               && !empty($value)
               && $value > 0;
    }
    public function getErrorMessage(): string
    {
        return 'Value must be a valid number.';
    }
}
