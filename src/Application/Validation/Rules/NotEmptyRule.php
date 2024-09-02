<?php 

namespace Application\Validation\Rules;

use Application\Validation\Rules\ValidationRule;

class NotEmptyRule implements ValidationRule {
    public function validate($value): bool{
        return trim($value) !== '';
    }

    public function getErrorMessage(): string{
        return 'Value cannot be empty.';
    }
}
