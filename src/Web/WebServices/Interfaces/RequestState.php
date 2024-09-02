<?php

namespace Web\WebServices\Interfaces;

use Web\WebServices\Abstracts\BaseController;

interface RequestState{
    public function HandleRequest(BaseController $controller): void;
}