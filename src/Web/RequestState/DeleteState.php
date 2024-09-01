<?php

namespace Web\RequestState;

use Web\WebServices\RequestState;
use Web\WebServices\BaseController;

class DeleteState implements RequestState{
    public function HandleRequest(BaseController $controller): void{
        $controller -> handleDelete();
    } 
}
