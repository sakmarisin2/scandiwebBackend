<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/Autoloader.php';
use Application\Router;
use Infrastructure\Database\Database;

$env = parse_ini_file('.env');
Autoloader::register();

set_exception_handler(['Infrastructure\Services\ErrorHandler', 'handleException']);
header("Content-type: application/json; charset=UTF-8");

$database = new Database(
    $env["HOST"],
    $env["NAME"],
    $env["USER"],
    $env["PSWD"],
    $env["PORT"],
    $env["CERT_PATH"]
);

$url = trim($_SERVER["REQUEST_URI"],"/");
$parts = explode("/",$url);

$endpoint = $parts[0] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router($database,$endpoint,$method);
$router ->route();

