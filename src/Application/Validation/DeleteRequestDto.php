<?php

namespace Application\Validation;

use Domain\Core\BaseProductDto;
use Application\Validation\Rules\ArrayRule;
use Application\Validation\Rules\IntegerRule;

class DeleteRequestDto extends BaseProductDto{

    private array $ids = [];
    private array $errors = [];
    private array $validationRules = [
        'integer' => [new IntegerRule()],
        'array' => [new ArrayRule()]
    ];
    public function __construct(array $attributes) {
        $this -> setAttributes($attributes);
    }
    public function setAttributes(array $attributes): void{
        $this ->validate('array',$attributes);
        foreach($attributes as $value){
            $this ->validate('integer',$value);
        }
        $this-> ids = $attributes;
    }
    public function getAttributes(): array{
        return $this ->ids;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    private function validate(string $field, $value): void
    {
        $rules = $this->validationRules[$field] ?? [];
        foreach ($rules as $rule) {
            if (!$rule->validate($value)) {
                $this->errors[] = $rule->getErrorMessage();
            }
        }
    }
}