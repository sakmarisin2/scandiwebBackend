<?php

namespace Domain\Entities;

use Domain\Core\BaseProduct;

class DVD extends BaseProduct{
    private array $attributes;

    public function __construct(string $SKU,
                                string $name,  
                                int $price, 
                                int $typeId,
                                int $size) {
        parent::__construct($name, $SKU, $price, $typeId);
        $this -> setSize($size);    
    }
    public function setSize(int $Size):void{
        $this->attributes = ["size" => $Size];
    }
    public function getAttributes():array{
        return $this->attributes;
    }
}