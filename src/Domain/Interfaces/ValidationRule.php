<?php

namespace Domain\Interfaces;

interface ValidationRule {
    public function validate($value): bool;
    public function getErrorMessage(): string;
}