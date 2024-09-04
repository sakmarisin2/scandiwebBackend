<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . './Autoloader.php';
use Web\Router;

Autoloader::register();

set_exception_handler(['Application\Services\ErrorHandler', 'handleException']);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json; charset=UTF-8');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
    http_response_code(204);
    exit();
}

$url = trim($_SERVER["REQUEST_URI"],"/");
$parts = explode("/",$url);

$endpoint = $parts[0] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$router = new Router($endpoint,$method);
$router ->route();

