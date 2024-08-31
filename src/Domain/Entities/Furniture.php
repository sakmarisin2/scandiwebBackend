<?php

namespace Domain\Entities;

use Domain\Core\BaseProduct;

class Furniture extends BaseProduct{

    private array $attributes = [];

    public function __construct(string $name, 
                                string $SKU, 
                                int $price, 
                                int $typeId,
                                int $height,
                                int $width,
                                int $length) {
        parent::__construct($name, $SKU, $price, $typeId);
        $this->setAttributes($height,$width,$length);
    }
    private function setAttributes(int $height, int $width, int $length): void {
        $this->attributes = [
            'height' => $height,
            'width' => $width,
            'length' => $length
        ];
    }
    
    public function getAttributes():array{
        return $this->attributes;
    }
}