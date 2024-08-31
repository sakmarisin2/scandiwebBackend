<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/Autoloader.php';
use Web\Router;

Autoloader::register();

set_exception_handler(['Application\Services\ErrorHandler', 'handleException']);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-type: application/json; charset=UTF-8");

$url = trim($_SERVER["REQUEST_URI"],"/");
$parts = explode("/",$url);

$endpoint = $parts[0] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}
$router = new Router($endpoint,$method);
$router ->route();

