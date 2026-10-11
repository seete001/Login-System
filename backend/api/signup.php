<?php

require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json; charset=utf-8');

// Helper function to easily respond
function respond($status, $success, $message){

    http_response_code($status);

    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);

    exit;
}

/*
 *
 * Signup : First we allow just post requests and then we decode the json format and validate them,
 * after all this we try to create user if it does not exist. Otherwise responding with 409 or 500.
 *
 */

// Only POST request
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Allow:POST');
    respond(405, false , 'Method not Allowed');
}

// JSON sent by front
$data = json_decode(file_get_contents('php://input'), true);

if(!is_array($data)){
    respond(400, false, 'Credentials missing');
}

// Read the fields
$fullName = $data['fullName'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

// Validating ...
if(!is_string($fullName) || trim($fullName) === '' || 
   !is_string($email) || !filter_var(trim($email), FILTER_VALIDATE_EMAIL) ||
   !is_string($password) || $password === ''){
    
    respond(400, false, 'Invalid credentials');
}

$fullName = trim($fullName);
$email = trim($email);

// Creating user

try{
    if(create_user($fullName, $email, $password)){
        respond(201, true, 'Account created successfully');
    }
    respond(409, false, 'Email may already be registered');
}catch (Throwable $e){
    error_log("Signup API error: " . $e->getMessage());
    respond(500, false, 'Internal Error');
}