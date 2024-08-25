<?php

namespace Application;

use Domain\Interfaces\RouterInterface;
use Application\Controllers\ProductController;
use Infrastructure\Database\Database;
use Domain\Core\BaseController;
use Infrastructure\Requests\DeleteState;
use Infrastructure\Requests\PostState;
use Infrastructure\Requests\GetState;
use PDO;

class Router implements RouterInterface{
    private PDO $conn;
    private BaseController $handler;
    private $methodToStateMap = [
        'GET'    => GetState::class,
        'POST'   => PostState::class,
        'DELETE' => DeleteState::class,
    ];
    private $endpointToControllerMap =[
        'products' => ProductController::class
    ];

    public function __construct(Database $db,string $endpoint,string $method)
    {
        $this->conn = $db->getConnection();
        $controllerClass = $this->endpointToControllerMap[$endpoint];
        $stateClass = $this->methodToStateMap[$method];
        $state = new $stateClass();
        $this->handler = new $controllerClass($state, $this->conn);
    }

    public function route(): void{
        $this->handler->handleRequest();
    }
}
