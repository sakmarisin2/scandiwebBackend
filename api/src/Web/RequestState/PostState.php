<?php

namespace Web\RequestState;

use Web\WebServices\Interfaces\RequestState;
use Web\WebServices\Abstracts\BaseController;

class PostState implements RequestState{
    public function HandleRequest(BaseController $controller): void{
        $controller -> handlePost();
    } 
}
