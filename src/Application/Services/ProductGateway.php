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
        $env = parse_ini_file('.env');
        $database = new Database(
            $env["HOST"],
            $env["NAME"],
            $env["USER"],
            $env["PSWD"],
            $env["SQL_PORT"],
            $env["CERT_PATH"]
        );
        $this ->repository = new ProductRepository($database -> getConnection());
    }

    public function getProducts(): array{

        $products = $this->repository->selectAll();

        return $products;
    }

    public function createProduct(PostRequestDto $data): int{

        $product = ProductFactory::create($data);

        $result = $this ->repository -> insert($product);

        return (int)$result;
    }

    public function deleteProducts(DeleteRequestDto $data): string{
        
        $result = $this->repository->delete($data -> getAttributes());

        return $result;
    }
}
