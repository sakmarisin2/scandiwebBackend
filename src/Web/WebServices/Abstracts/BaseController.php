<?php

namespace Web\WebServices\Abstracts;

use Web\WebServices\Interfaces\RequestState;

abstract class BaseController{
    abstract protected function getPayload():void;
    abstract function setState(RequestState $state):void;

    abstract function handleRequest():void;

    abstract function handleGet():void;
    abstract function handlePost():void;
    abstract function handleDelete():void;
}