<?php

namespace Application\Validation;

use Domain\Interfaces\ValidatorInterface;
use Application\Validation\Rules\ArrayRule;
use Application\Validation\Rules\IntegerRule;
use Application\Validation\Rules\NotEmptyRule;

class ValidatePostData implements ValidatorInterface {
    private array $rules;

    public function __construct() {
        $this->rules = [
            'name' => [new NotEmptyRule()],
            'SKU' => [new NotEmptyRule()],
            'price' => [new IntegerRule()],
            'type' => [new IntegerRule()],
            'attributes' => [new ArrayRule()],
        ];
    }

    public function validate(array $data): bool{
        $validationResults = array_map(
            fn($key, $rules) => $this->applyRules($data[$key] ?? null, $rules),
            array_keys($this->rules),
            $this->rules
        );

        $allFieldsValid = array_reduce(
            $validationResults,
            fn($carry, $result) => $carry && $result,
            true
        );

        $productsValidation = isset($data["products"]) || !empty($data["name"]);

        return $allFieldsValid && $productsValidation;
    }

    private function applyRules($value, array $rules): bool{
        return array_reduce(
            $rules,
            fn($carry, $rule) => $carry && $rule->validate($value),
            true
        );
    }
}
