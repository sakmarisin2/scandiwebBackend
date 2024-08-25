<?php

namespace Domain\Interfaces;

interface ValidatorInterface
{
    public function validate(array $data): bool;
}
