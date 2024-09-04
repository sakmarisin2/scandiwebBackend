<?php

namespace Application\Validation\Rules;
interface ValidationRule {
    public function validate($value): bool;
    public function getErrorMessage(): string;
}