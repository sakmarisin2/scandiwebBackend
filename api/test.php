<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=UTF-8');

echo json_encode(['status' => 'ok', 'message' => 'Hello from PHP on Vercel!']);
