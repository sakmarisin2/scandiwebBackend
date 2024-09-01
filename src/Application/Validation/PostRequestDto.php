<?php

namespace Application\Validation;

use Domain\Core\BaseProductDto;
use Application\Validation\Rules\ArrayRule;
use Application\Validation\Rules\IntegerRule;
use Application\Validation\Rules\NotEmptyRule;
use Application\Validation\Rules\HtmlSpecialCharsRule;
use Application\Validation\Rules\NotNumericRule;

class PostRequestDto extends BaseProductDto{
    private string $name;
    private string $SKU;
    private int $price;
    private int $typeId;
    private array $attributes;
    private array $errors = [];
    private array $validationRules = [
        'string' => [new NotEmptyRule(), 
                     new HtmlSpecialCharsRule(),
                     new NotNumericRule()],
        'integer' => [new IntegerRule()],
        'array' => [new ArrayRule()]
    ];
    public function __construct(string $SKU, 
                                string $name, 
                                int $price, 
                                int $typeId,
                                array $attributes) {
        $this->setName($name);
        $this->setSKU($SKU);
        $this->setPrice($price);
        $this->setType($typeId);
        $this->setAttributes($attributes);
    }
    public function setSKU(string $SKU):void{
        $this -> validate('string',$SKU);
        $this->SKU=$SKU;
    }
    public function getSKU():string{
        return $this->SKU;
    }

    public function setName(string $name):void{
        $this -> validate('string',$name);
        $this->name=$name;
    }
    public function getName():string{
        return $this->name;
    }

    public function setPrice(int $price):void{
        $this -> validate('integer',$price);
        $this->price = $price;
    }
    public function getPrice():int{
        return $this->price;
    }

    public function setType(int $typeId):void{
        $this -> validate('integer',$typeId);
        $this->typeId= $typeId;
    }
    public function getType():int{
        return $this->typeId;
    }
    public function setAttributes(array $attributes): void{
        $this -> validate('array',$attributes);
        foreach($attributes as $key=>$value){
            $this -> validate('string',$value);
        }
        $this->attributes = $attributes;
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