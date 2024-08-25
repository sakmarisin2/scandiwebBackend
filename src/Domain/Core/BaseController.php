<?php
namespace Domain\Core;

use Domain\Interfaces\RequestState;

abstract class BaseController{
    abstract protected function getPayload():void;
    abstract function setState(RequestState $state):void;

    abstract function handleRequest():void;

    abstract function handleGet():void;
    abstract function handlePost():void;
    abstract function handleDelete():void;
}