<?php

namespace Application\Validation;

use Web\WebServices\Abstracts\BaseRequestDto;
use Application\Validation\Rules\ArrayRule;
use Application\Validation\Rules\IntegerRule;

class DeleteRequestDto extends BaseRequestDto{

    protected array $attributes;
    protected array $errors = [];
    private array $validationRules = [];
    public function __construct(array $attributes) {
        $this-> validationRules =[
            'integer' => [new IntegerRule()],
            'array' => [new ArrayRule()]
        ];
        
        $this -> setAttributes($attributes);
    }
    public function setAttributes(array $attributes): void{
        $this ->validate($attributes,$this->validationRules['array']);
        foreach($attributes as $value){
            $this ->validate($value,$this->validationRules['integer']);
        }
        $this-> attributes = $attributes;
    }
    public function getAttributes(): array{
        return $this ->attributes;
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