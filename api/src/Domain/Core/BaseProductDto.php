<?php

namespace Domain\Core;

abstract class BaseProductDto{
    protected string $name;
    protected string $SKU;
    protected float $price;
    protected string $type;
    public function __construct(string $name, string $SKU, float $price, string $type) {
        $this->setName($name);
        $this->setSKU($SKU);
        $this->setPrice($price);
        $this->setType($type);
    }   
    public function setSKU(string $SKU):void{
        $this->SKU=$SKU;
    }
    public function getSKU():string{
        return $this->SKU;
    }

    public function setName(string $name):void{
        $this->name=$name;
    }
    public function getName():string{
        return $this->name;
    }

    public function setPrice(float $price):void{
        $this->price = $price;
    }
    public function getPrice():float{
        return $this->price;
    }

    public function setType(string $type):void{
        $this->type= $type;
    }
    public function getType():string{
        return $this->type;
    }

    abstract function getAttributes():array;
}