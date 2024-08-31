<?php

namespace Domain\Entities;

use Domain\Core\BaseProduct;

class Book extends BaseProduct{

    private array $attributes;

    public function __construct(string $name, 
                                string $SKU, 
                                int $price, 
                                int $typeId,
                                int $weight) {
        parent::__construct($name, $SKU, $price, $typeId);
        $this -> setWeight($weight);
    }

    public function setWeight(int $weight):void{
        $this->attributes = ["weight"=>$weight];
    }
    public function getAttributes():array{
        return $this->attributes;
    }
}