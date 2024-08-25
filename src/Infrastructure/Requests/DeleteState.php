<?php
namespace Infrastructure\Requests;
use Domain\Interfaces\RequestState;
use Domain\Core\BaseController;

class DeleteState implements RequestState{
    public function HandleRequest(BaseController $controller):void{
        $controller -> handleDelete();
    } 
}