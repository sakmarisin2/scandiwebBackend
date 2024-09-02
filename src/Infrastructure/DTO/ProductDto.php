<?php

namespace Infrastructure\DTO;

use Domain\Core\BaseProduct;

class ProductDto extends BaseProduct{
    private int $id;
    private array $attributes;

    public function __construct(int $id,
                                string $name, 
                                string $SKU, 
                                int $price, 
                                int $typeId,
                                array $attributes) {
        parent::__construct($name, $SKU, $price, $typeId);
        $this-> setId($id);
        $this->setAttributes($attributes);   
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