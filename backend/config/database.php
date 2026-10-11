<?php
function db_init(){

    $dbPath = __DIR__ . "/../../database/platform.db";

    try{
        $pdo = new PDO("sqlite:". $dbPath);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $initQuery = "CREATE TABLE IF NOT EXISTS users(
            id INTEGER PRIMARY KEY AUTOINCREMENT  ,
            fullName TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            passHash TEXT NOT NULL,
            regDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
    
        $pdo->exec($initQuery);
    
        return $pdo;

    }catch (PDOException $e){
        error_log("Database connection failed: " . $e->getMessage());
        return false;
    }
}

function create_user($fullName, $email, $password){
    $pdo = db_init();

    $passHash = password_hash($password, PASSWORD_DEFAULT);

    try{
        $query = "INSERT INTO users (fullName, email, passHash)
                  VAlUES (:fullName, :email, :passHash)";
        $stmt = $pdo->prepare($query);

        $stmt->execute([
            ':fullName' => $fullName,
            ':email' => $email,
            ':passHash' => $passHash
        ]);

        return true;

    }catch (PDOException $e){
 
        return false;

    }finally{
 
        $pdo = null;
    }
}

function search_user($email){
    $pdo = db_init();

    try{
        $query = "SELECT id, fullName, email, passHash, regDate FROM users
                  WHERE email = :email
                  LIMIT 1";

        $stmt = $pdo->prepare($query);

        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch();

        return $user ?: false;

    }catch (PDOException $e){

        return false;

    }finally{
        $pdo = null;
    }
}

?>