<?php
namespace Domain\Interfaces;
use Domain\Core\BaseController;

interface RequestState{
    public function HandleRequest(BaseController $controller): void;
}