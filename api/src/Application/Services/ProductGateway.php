<?php

namespace Application\Services;

use Application\Factories\ProductFactory;
use Application\Validation\DeleteRequestDto;
use Application\Validation\PostRequestDto;
use Domain\Interfaces\GatewayInterface;
use Infrastructure\Repos\ProductRepository;
use Infrastructure\Database\Database;

class ProductGateway implements GatewayInterface{
    private ProductRepository $repository;

    public function __construct()
    {
        $database = new Database(
            getenv("HOST"),
            getenv("NAME"),
            getenv("USER"),
            getenv("PSWD"),
            getenv("SQL_PORT"),
            getenv("CERT_PATH")
        );
        $this ->repository = new ProductRepository($database -> getConnection());
    }

    public function getProducts(): array{

        $products = $this->repository->selectAll();

        return $products;
    }

    public function createProduct(PostRequestDto $data): ?int{
        $exist = $this ->repository->productExistsBySku($data -> getSKU());
        if($exist){
            return null;
        }
        $product = ProductFactory::create($data);

        $result = $this ->repository -> insert($product);

        return (int)$result;
    }

    public function deleteProducts(DeleteRequestDto $data): string{
        
        $result = $this->repository->delete($data -> getAttributes());

        return $result;
    }
}
