<?php

namespace Web\WebServices;

interface ResponseStrategy {
    public function handle($data): void;
}