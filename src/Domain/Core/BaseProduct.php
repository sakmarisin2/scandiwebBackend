<?php

namespace Domain\Core;

abstract class BaseProduct{
    protected string $name;
    protected string $SKU;
    protected int $price;
    protected int $typeId;
    public function __construct(string $name, string $SKU, int $price, int $typeId) {
        $this->setName($name);
        $this->setSKU($SKU);
        $this->setPrice($price);
        $this->setType($typeId);
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

    public function setPrice(int $price):void{
        $this->price = $price;
    }
    public function getPrice():int{
        return $this->price;
    }

    public function setType(int $typeId):void{
        $this->typeId= $typeId;
    }
    public function getType():int{
        return $this->typeId;
    }

    abstract function getAttributes():array;
}