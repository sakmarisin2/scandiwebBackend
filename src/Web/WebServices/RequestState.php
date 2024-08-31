<?php

namespace Web\WebServices;

use Web\WebServices\BaseController;

interface RequestState{
    public function HandleRequest(BaseController $controller): void;
}