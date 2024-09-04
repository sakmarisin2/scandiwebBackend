<?php

namespace Web\WebServices\Interfaces;

interface ResponseStrategy {
    public function handle($data): void;
}