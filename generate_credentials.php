<?php
include 'db.php';

function generateUniqueUsername($pdo) {
    $base = "user_";
    $number = rand(1000, 9999); // Generate a random number
    $username = $base . $number;

    // Check if the username already exists
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);
    
    if($query->rowCount() > 0) {
        // If username exists, recursively call the function until a unique one is found
        return generateUniqueUsername($pdo);
    } else {
        return $username;
    }
}

function generatePassword() {
    $password = bin2hex(random_bytes(5)); // Generate a random string
    return $password;
}

$username = generateUniqueUsername($pdo);
$password = generatePassword();

echo json_encode(array("username" => $username, "password" => $password));
?>
