<?php

namespace Domain\Interfaces;

interface ResponseStrategy {
    public function handle($data): void;
}