<?php 

namespace Application\Validation\Rules;

use Domain\Interfaces\ValidationRule;

class NotNumericRule implements ValidationRule {
    public function validate($value): bool{
        return !is_numeric( $value );
    }

    public function getErrorMessage(): string{
        return 'Value cannot be empty.';
    }
}
