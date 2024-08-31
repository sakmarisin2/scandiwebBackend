<?php

namespace Web;

use Web\WebServices\ResponseStrategy;

class ResponseContext {
    private ResponseStrategy $strategy;

    public function __construct(ResponseStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(ResponseStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function executeStrategy($data): void {
        $this->strategy->handle($data);
    }
}