<?php

namespace Infrastructure\Services;

use Domain\Entities\Product;
use Domain\Interfaces\GatewayInterface;
use Infrastructure\Database\Repos\ProductRepository;
use Infrastructure\Validation\ValidatePostData;
use Infrastructure\Services\ValidatorManager;

class ProductGateway implements GatewayInterface{
    private ProductRepository $repository;
    private ValidatorManager $validator;

    public function __construct(ProductRepository $repository)
    {
        $this ->repository = $repository;
        $this ->validator = new ValidatorManager(
            new ValidatePostData()
        );
    }

    public function getAll(): array{
        $products = $this->repository->selectAll();
        return $products;
    }

    public function createProduct(array $data):?int{
        if (!$this->validator->validate($data)) {
            return null;
        }

        $product = new Product();
        $product -> setName($data["name"]);
        $product -> setSKU($data["SKU"]);
        $product -> setPrice($data["price"]);
        $product -> setType($data["type"]);
        $product -> setAttributes($data["attributes"]);

        $result = $this ->repository -> insert($product);

        return (int)$result;
    }

    public function deleteProducts(array $data):?string{
        if (!$this->validator->validate($data)) {
            return null;
        }
        
        $result = $this->repository->delete($data["products"]);
        return $result;
    }
}