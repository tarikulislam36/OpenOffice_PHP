<?php
include 'db.php';

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Normally you hash this
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    
    if($query->execute([$username, $hashedPassword])) {
        echo json_encode(array("status" => "success", "username" => $username, "password" => $password));
    } else {
        echo json_encode(array("status" => "error"));
    }
}
?>
