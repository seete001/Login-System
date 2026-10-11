<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


if (
    str_starts_with($path, '/frontend/static/') &&
    is_file(__DIR__ . $path)
) {
    return false;
}

$routes = [
    'GET' => [
        '/' => __DIR__ . '/frontend/templates/login.html',
        '/login' => __DIR__ . '/frontend/templates/login.html',
        '/signup' => __DIR__ . '/frontend/templates/signup.html',
        '/dashboard' => __DIR__ . '/backend/api/dashboard.php',
    ],
    'POST' => [
        '/logout' => __DIR__ . '/backend/api/logout.php',
        '/api/signup' => __DIR__ . '/backend/api/signup.php',
        '/api/login' => __DIR__ . '/backend/api/login.php',
    ],
];

if(isset($routes[$method][$path])){
    require $routes[$method][$path];
    exit;
}

http_response_code(404);
echo '404 - Page not found';

?>