<?php

namespace Domain\Interfaces;

use Application\Validation\DeleteRequestDto;
use Application\Validation\PostRequestDto;

interface GatewayInterface{
    public function getProducts(): array;
    public function createProduct(PostRequestDto $data): ?int;
    public function deleteProducts(DeleteRequestDto $data): string;

}
