<?php

namespace Domain\Interfaces;

interface GatewayInterface{
    public function getProducts(): array;
    public function createProduct(array $data): ?int;
    public function deleteProducts(array $data): ?string;

}
