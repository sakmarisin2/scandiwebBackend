<?php

namespace Web;

use Web\Controllers\ProductController;
use Web\WebServices\Interfaces\RouterInterface;
use Web\WebServices\Abstracts\BaseController;
use Web\RequestState\DeleteState;
use Web\RequestState\PostState;
use Web\RequestState\GetState;

class Router implements RouterInterface{
    private BaseController $handler;
    private $methodToStateMap = [
        'GET'    => GetState::class,
        'POST'   => PostState::class,
        'DELETE' => DeleteState::class,
    ];
    private $endpointToControllerMap =[
        'products' => ProductController::class
    ];

    public function __construct(string $endpoint,string $method)
    {
        if (!isset($this->endpointToControllerMap[$endpoint])) {
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
            exit;
        }
        $controllerClass = $this->endpointToControllerMap[$endpoint];
        $stateClass = $this->methodToStateMap[$method];
        $state = new $stateClass();
        $this->handler = new $controllerClass($state);
    }

    public function route(): void{
        $this->handler->handleRequest();
    }
}
