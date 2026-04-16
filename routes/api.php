<?php

use App\Controllers\AuthController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$path = $uri;

if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
    $path = substr($uri, strlen($scriptDir));
}

$path = '/' . trim($path, '/');
$method = $_SERVER['REQUEST_METHOD'];

$auth = new AuthController();

if ($path === '/api/signup' && $method === 'POST') {
    $auth->signup();
} elseif ($path === '/api/login' && $method === 'POST') {
    $auth->login();
} else {
    echo json_encode(['error' => 'Route not found']);
}
