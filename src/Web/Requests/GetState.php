<?php

namespace Web\Requests;

use Web\WebServices\RequestState;
use Web\WebServices\BaseController;

class GetState implements RequestState{
    public function HandleRequest(BaseController $controller): void{
        $controller -> handleGet();
    } 
}
