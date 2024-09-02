<?php

namespace Web\WebServices\Abstracts;

abstract class BaseRequestDto {
    protected array $attributes = [];
    protected array $errors = [];

    abstract public function setAttributes(array $attributes): void;
    abstract public function getAttributes(): array;

    public function getErrors(): array {
        return $this->errors;
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }

    protected function validate(string $field, $value, array $rules): void {
        foreach ($rules as $rule) {
            if (!$rule->validate($value)) {
                $this->errors[] = $rule->getErrorMessage();
            }
        }
    }
}
