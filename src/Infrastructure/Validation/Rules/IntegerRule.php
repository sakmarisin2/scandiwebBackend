<?php
namespace Infrastructure\Validation\Rules;
use Domain\Interfaces\ValidationRule;

class IntegerRule implements ValidationRule {
    public function validate($value): bool{
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }
}
