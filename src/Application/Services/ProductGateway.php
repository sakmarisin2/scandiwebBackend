<?php

namespace Application\Services;

use Application\Validation\ValidatePostData;
use Application\Services\ValidatorManager;
use Application\Factories\ProductFactory;
use Domain\Interfaces\GatewayInterface;
use Infrastructure\Repos\ProductRepository;
use Infrastructure\Database\Database;

class ProductGateway implements GatewayInterface{
    private ProductRepository $repository;
    private ValidatorManager $validator;

    public function __construct()
    {
        $env = parse_ini_file('.env');
        $database = new Database(
            $env["HOST"],
            $env["NAME"],
            $env["USER"],
            $env["PSWD"],
            $env["PORT"],
            $env["CERT_PATH"]
        );
        $this ->repository = new ProductRepository($database -> getConnection());
        $this ->validator = new ValidatorManager(
            new ValidatePostData()
        );
    }

    public function getProducts(): array{
        $products = $this->repository->selectAll();
        return $products;
    }

    public function createProduct(array $data): ?int{
        if (!$this->validator->validate($data)) {
            return null;
        }

        $product = ProductFactory::create($data);

        $result = $this ->repository -> insert($product);

        return (int)$result;
    }

    public function deleteProducts(array $data): ?string{
        
        $result = $this->repository->delete($data["products"]);
        return $result;
    }
}
