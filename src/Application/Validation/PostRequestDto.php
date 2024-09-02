<?php

namespace Application\Validation;

use Web\WebServices\Abstracts\BaseRequestDto;
use Application\Validation\Rules\ArrayRule;
use Application\Validation\Rules\IntegerRule;
use Application\Validation\Rules\NotEmptyRule;
use Application\Validation\Rules\HtmlSpecialCharsRule;
use Application\Validation\Rules\NotNumericRule;

class PostRequestDto extends BaseRequestDto{
    private string $name;
    private string $SKU;
    private int $price;
    private int $typeId;
    protected array $attributes;
    protected array $errors = [];
    private array $validationRules = [];
    public function __construct(string $SKU, 
                                string $name, 
                                int $price, 
                                int $typeId,
                                array $attributes) {
        $this->validationRules = [
            'string' => [new NotEmptyRule(), 
                         new HtmlSpecialCharsRule(),
                         new NotNumericRule()],
            'integer' => [new IntegerRule()],
            'array' => [new ArrayRule()]
        ];
        $this->setName($name);
        $this->setSKU($SKU);
        $this->setPrice($price);
        $this->setType($typeId);
        $this->setAttributes($attributes);
    }
    public function setSKU(string $SKU):void{
        $this -> validate($SKU,$this->validationRules['string']);
        $this->SKU=$SKU;
    }
    public function getSKU():string{
        return $this->SKU;
    }

    public function setName(string $name):void{
        $this -> validate($name,$this->validationRules['string']);
        $this->name=$name;
    }
    public function getName():string{
        return $this->name;
    }

    public function setPrice(int $price):void{
        $this -> validate($price,$this->validationRules['integer']);
        $this->price = $price;
    }
    public function getPrice():int{
        return $this->price;
    }

    public function setType(int $typeId):void{
        $this -> validate($typeId,$this->validationRules['integer']);
        $this->typeId= $typeId;
    }
    public function getType():int{
        return $this->typeId;
    }
    public function setAttributes(array $attributes): void{
        $this -> validate($attributes,$this->validationRules['array']);
        foreach($attributes as $key=>$value){
            $this -> validate($value,$this->validationRules['integer']);
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
}