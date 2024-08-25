<?php
namespace Infrastructure\Validation\Rules;
use Domain\Interfaces\ValidationRule;


class ArrayRule implements ValidationRule {
    public function validate($value): bool {
        return is_array($value);
    }
}