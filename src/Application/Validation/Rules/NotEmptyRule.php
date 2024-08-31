<?php 

namespace Application\Validation\Rules;

use Domain\Interfaces\ValidationRule;

class NotEmptyRule implements ValidationRule {
    public function validate($value): bool{
        return !empty($value);
    }
}
