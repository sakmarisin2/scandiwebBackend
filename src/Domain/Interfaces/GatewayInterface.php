<?php

namespace Domain\Interfaces;

interface GatewayInterface{
    public function GetAll(): array;
    public function CreateProduct(array $data):?int;
    public function DeleteProducts(array $data):?string;

}