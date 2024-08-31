<?php

namespace Web\Controllers;

use Web\ResponseContext;
use Web\WebServices\BaseController;
use Web\WebServices\RequestState;
use Application\Services\ProductGateway;
use Application\Factories\ResponseFactory;

class ProductController extends BaseController {
    private RequestState $state;
    private ProductGateway $gateway;
    private array $payload;
    private ResponseContext $responseContext;

    public function __construct(RequestState $state) {
        $this->state = $state;
        $this->gateway = new ProductGateway();
        $this->responseContext = new ResponseContext(ResponseFactory::createStrategy('default'));
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

        $this->responseContext->setStrategy(ResponseFactory::createStrategy($data));
        $this->responseContext->executeStrategy($data ?? []);
    }

    public function handlePost(): void {

        $this->getPayload();
        $result = $this->gateway->createProduct($this->payload);

        $this->responseContext->setStrategy(ResponseFactory::createStrategy($result));
        $this->responseContext->executeStrategy($result);
    }

    public function handleDelete(): void {

        $this->getPayload();
        $result = $this->gateway->deleteProducts($this->payload);

        $this->responseContext->setStrategy(ResponseFactory::createStrategy($result));
        $this->responseContext->executeStrategy([
            'message' => 'Success',
            'Products deleted' => $result
        ]);
    }
}
