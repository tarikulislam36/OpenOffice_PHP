<?php
include 'db.php';
session_start();

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);
    $user = $query->fetch();

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        echo $_SESSION['user_id'];
        echo json_encode(array("status" => "success", "username" => $username));
    } else {
        echo json_encode(array("status" => "failed"));
    }
}
?>
