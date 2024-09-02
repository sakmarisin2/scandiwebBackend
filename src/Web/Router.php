<?php

namespace Web;

use Web\WebServices\RouterInterface;
use Web\Controllers\ProductController;
use Web\WebServices\BaseController;
use Web\Requests\DeleteState;
use Web\Requests\PostState;
use Web\Requests\GetState;

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
