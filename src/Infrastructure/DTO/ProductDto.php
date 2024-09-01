<?php

namespace Infrastructure\DTO;

use Domain\Core\BaseProductDto;

class ProductDto extends BaseProductDto{
    private int $id;
    private string $name;
    private string $SKU;
    private int $price;
    private int $typeId;
    private array $attributes;
    public function __construct(int $id,
                                string $SKU, 
                                string $name, 
                                int $price, 
                                int $typeId,
                                array $attributes) {

        $this -> setId($id);
        $this->setName($name);
        $this->setSKU($SKU);
        $this->setPrice($price);
        $this->setType($typeId);
        $this->setAttributes($attributes);
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
    public function setId(int $id): void{
        $this -> id = $id;
    }
    public function getId(): int{
        return $this -> id;
    }
    public function setAttributes(array $attributes): void{
        $this->attributes = $attributes;
    }
    public function getAttributes(): array{
        return $this ->attributes;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'SKU' => $this->getSKU(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'typeId' => $this->getType(),
            'attributes' => $this->getAttributes()
        ];
    }
}