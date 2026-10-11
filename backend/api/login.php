<?php

require_once __DIR__ . '/../config/database.php';

session_start();

header('Content-Type: application/json;charset=utf-8');

// Helper
function respond($status, $success, $message){
    http_response_code($status);

    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);

    exit;
}
/**
 * 
 * 
 * We allow just post requests and then decode the data, validate them and then,
 * try to search the user in db if it is not found or found and the password's hash,
 * mismatches then 401 response , otherwise passed.
 * 
 * 
 */


if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Allow: Post');
    respond(405, false, 'Mehtod not Allowed');
}

$data = json_decode(file_get_contents('php://input'), true);

if(!is_array($data)){
    respond(400, false, 'Credentials missing');
}

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if( !is_string($email) || 
    !filter_var(trim($email), FILTER_VALIDATE_EMAIL) || 
   !is_string($password) ||
   $password === ''){

    respond(400, false, 'Invalid Credentials');
   }

$email = trim($email);

try{
    $user = search_user($email);

    if(!$user || !password_verify($password, $user['passHash'])){
        respond(401, false, 'Invalid email or password');
    }

    // Credentials are valid
    // Session

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['fullName'];
    $_SESSION['user_email'] = $user['email'];

    respond(200, true, 'Login successful');

}catch (Throwable $e){
    error_log("Login API error: " . $e->getMessage());
    respond(500, false, 'Internal Error');
}

?>