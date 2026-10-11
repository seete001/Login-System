<?php

session_start();

if($_SERVER['REQUEST_METHOD' ]!== 'POST'){
    header('Allow: POST');
    http_response_code(405);
    exit('Mehtod not Allowed');
}

$_SESSION = [];

if(ini_get('session.use_cookies')){
    $params = session_get_cookie_params();

    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $params['path'],
        'domain' => $params['domain'],
        'secure' => $params['secure'],
        'httponly' => $params['httponly'],
        'samesite' => $params['path'] ?? 'Lax'
    ]);
}

session_destroy();

header('Location: /login');
exit;

?>