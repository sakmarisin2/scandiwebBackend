<?php

namespace Web\RequestState;

use Web\WebServices\RequestState;
use Web\WebServices\BaseController;

class GetState implements RequestState{
    public function HandleRequest(BaseController $controller): void{
        $controller -> handleGet();
    } 
}
