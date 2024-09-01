<?php

namespace Web\Controllers;

use Web\ResponseContext;
use Web\WebServices\BaseController;
use Web\WebServices\RequestState;
use Application\Services\ProductGateway;
use Application\Factories\ResponseFactory;
use Application\Validation\PostRequestDto;
use Application\Validation\DeleteRequestDto;
use Application\Transformers\ProductDtoTransformer;

class ProductController extends BaseController {
    private RequestState $state;
    private ProductGateway $gateway;
    private array $payload;
    private ResponseContext $responseContext;

    public function __construct(RequestState $state) {
        $this->state = $state;
        $this->gateway = new ProductGateway();
        $this->responseContext = new ResponseContext(ResponseFactory::create('default'));
    }

    protected function getPayload(): void {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        $this->payload = json_last_error() === JSON_ERROR_NONE ? $data : [];
    }

    public function setState(RequestState $state): void {
        $this->state = $state;
    }

    public function handleRequest(): void {
        $this->state->handleRequest($this);
    }

    public function handleGet(): void {

        $data = $this->gateway->getProducts();
        $productArray = ProductDtoTransformer::transformCollection($data);

        $this->responseContext->setStrategy(ResponseFactory::create($productArray));
        $this->responseContext->executeStrategy($productArray ?? []);
    }

    public function handlePost(): void {

        $this->getPayload();
        $payload = $this->payload;
        $dto = new PostRequestDto($payload['SKU'],
                                  $payload['name'],
                                  $payload['price'],
                                  $payload['type'],
                                  $payload['attributes']);
        if($dto -> hasErrors()) {
            $this->responseContext->setStrategy(ResponseFactory::create('default'));
            $this->responseContext->executeStrategy($dto->getErrors() ?? []);
        }
        $result = $this->gateway->createProduct($dto);

        $this->responseContext->setStrategy(ResponseFactory::create($result));
        $this->responseContext->executeStrategy($result);
    }

    public function handleDelete(): void {

        $this->getPayload();
        $data = $this->payload;
        $dto = new DeleteRequestDto($data['products']);

        if($dto -> hasErrors()) {
            $this->responseContext->setStrategy(ResponseFactory::create('default'));
            $this->responseContext->executeStrategy($dto->getErrors() ?? []);
        }

        $result = $this->gateway->deleteProducts($dto);

        $this->responseContext->setStrategy(ResponseFactory::create($result));
        $this->responseContext->executeStrategy([
            'message' => 'Success',
            'Products deleted' => $result
        ]);
    }
}
