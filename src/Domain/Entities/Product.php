<?php

namespace Domain\Entities;
use Domain\Core\BaseProduct;
class Product extends BaseProduct
{
    private $SKU;
    private $name;
    private $price;
    private $type_id;

    private $attributes;

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

    public function setPrice(string $price):void{
        $this->price = $price;
    }
    public function getPrice():string{
        return $this->price;
    }

    public function setType(int $type_id):void{
        $this->type_id= $type_id;
    }
    public function getType():int{
        return $this->type_id;
    }

    public function setAttributes(array $attributes):void{
        $this->attributes= $attributes;
    }
    public function getAttributes():array{
        return $this->attributes;
    }
}