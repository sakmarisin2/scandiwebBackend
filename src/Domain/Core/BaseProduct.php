<?php

namespace Domain\Core;

abstract class BaseProduct{
 
    abstract function setSKU(string $SKU):void;
    abstract function getSKU():string;

    abstract function setName(string $name):void;
    abstract function getName():string;

    abstract function setPrice(string $price):void;
    abstract function getPrice():string;

    abstract function setType(int $type_id):void;
    abstract function getType():int;

    abstract function setAttributes(array $attributes):void;
    abstract function getAttributes():array;

}