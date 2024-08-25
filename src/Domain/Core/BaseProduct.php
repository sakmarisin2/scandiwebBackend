<?php

namespace Domain\Core;

abstract class BaseProduct{
 
    abstract function setSKU(string $SKU);
    abstract function getSKU();

    abstract function setName(string $name);
    abstract function getName();

    abstract function setPrice(string $price);
    abstract function getPrice();

    abstract function setType(int $type_id);
    abstract function getType();

    abstract function setAttributes(array $attributes):void;
    abstract function getAttributes():array;

}