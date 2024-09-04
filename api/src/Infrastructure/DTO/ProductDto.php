<?php

namespace Infrastructure\DTO;

use Domain\Core\BaseProductDto;

class ProductDto extends BaseProductDto{
    private int $id;
    private array $attributes;

    public function __construct(int $id,
                                string $SKU, 
                                string $name, 
                                float $price, 
                                string $type,
                                array $attributes) {
        parent::__construct($name, $SKU, $price, $type);
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
            'price' => number_format($this->getPrice(), 2),
            'type' => $this->getType(),
            'attributes' => $this->getAttributes()
        ];
    }
}