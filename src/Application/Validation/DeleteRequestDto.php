<?php

namespace Application\Validation;

use Web\WebServices\Abstracts\BaseRequestDto;
use Application\Validation\Rules\ArrayRule;
use Application\Validation\Rules\IntegerRule;

class DeleteRequestDto extends BaseRequestDto{

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
        $this ->validate('array',$attributes,$this->validationRules);
        foreach($attributes as $value){
            $this ->validate('integer',$value,$this->validationRules);
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
}