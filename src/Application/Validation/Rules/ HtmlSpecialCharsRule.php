<?php

namespace Application\Validation\Rules;

use Application\Validation\Rules\ValidationRule;

class HtmlSpecialCharsRule implements ValidationRule {
    public function validate($value): bool
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8') === $value;
    }

    public function getErrorMessage(): string
    {
        return 'Value contains special HTML characters.';
    }
}