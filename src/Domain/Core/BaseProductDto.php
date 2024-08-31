<?php
namespace Domain\Core;

abstract class BaseProductDto{

    abstract function setAttributes(array $attributes):void;
    abstract function getAttributes():array;
}