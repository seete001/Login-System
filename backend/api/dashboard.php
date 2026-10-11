<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: /login');
    exit;
}

$htmlPath = __DIR__ . '/../../frontend/templates/dashboard.html';

if(!is_file($htmlPath)){
    http_response_code(500);
    exit('Dashboard not found');
}

header('Content-Type: text/html; charset=UTF-8');
readfile($htmlPath);

?>